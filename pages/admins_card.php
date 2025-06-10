<?php 
$method = $_SERVER['REQUEST_METHOD'];


if ($method === 'GET') {
//header('Content-Type: application/json');
  
    $product_id = $_GET['id'] ?? null;
    $product_id = 43;

    if ($product_id) {
        

        try {
            $pdo = new PDO('pgsql:host=localhost;port=5433;dbname=valleyb', "mainuser", "Town56Mercury");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT
                    p.id AS product_id,
                    p.name AS product_name,
                    sku,
                    price,
                    description,
                    warranty,
                    height,
                    width,
                    length,
                    shelf_count,
                    drawer_count,
                    m.name AS material_name,
                    c.name AS color_name,
                    ft.name AS furniture_type_name,
                    fst.name AS furniture_subtype_name
                    
                FROM
                    public.product p
                JOIN
                    material m ON p.material_id = m.id
                JOIN
                    color c ON p.color_id = c.id
                JOIN
                    furniture_type ft ON p.furniture_type_id = ft.id
                JOIN
                    furniture_subtype fst ON p.furniture_subtype_id = fst.id
                WHERE p.id = :p_id;";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':p_id', $product_id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch();



// получения изображений
$query = "SELECT id, name FROM public.image WHERE product_id = :p_id;";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':p_id', $product_id, PDO::PARAM_INT);
$stmt->execute();
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);




} catch (Exception $e) {
    echo($e->getMessage());


 
}
} else {
       
}
}



?>



<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Card</title>

	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../styles/card.css">
	<link rel="stylesheet" type="text/css" href="../styles/color.css">   

  </head>
  <body>
	<header>
	<nav class="navbar navbar-expand-lg navbar-light  lavand-1">
    <div class="container-xl pt-2 contnt1">
        <!-- Логотип -->
        <a class="navbar-brand" href="../">
            <!--<img src="user.svg" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">-->
            <span class="logo ">ДолинаПолок</span>
        </a>

        <!-- Кнопка для раскрытия меню на мобильных устройствах -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Основное содержимое панели -->
        <div class="collapse navbar-collapse " id="navbarNav">


            <!-- Поиск -->
            <form class="d-flex flex-grow-1 me-2 search_form">
                <input class="form-control me-2" style="border-color:transparent; "   type="search" placeholder="Поиск" aria-label="Search">
                <button class="btn" style="background-color: #655CAB; color: white" type="submit">Найти</button>
                
            </form>
            <button class="btn btn-2 me-2" data-bs-toggle="modal" data-bs-target="#filterModal">Фильтр</button>

            <!-- Ссылки на личный кабинет и корзину -->
            <ul class="navbar-nav">
                <li class="nav-item d-flex   ">
                    <a class="nav-link d-flex flex-column align-items-center" href="../registr.php">
                        <img src="../img/user.svg" width="30" height="30" alt="User Icon">       
                    <small class="ml-2">Профиль</small>
                    </a>	
                </li>
                <li class="nav-item d-flex ">
                    <a class="nav-link d-flex flex-column align-items-center" href="../shopping_cart.php">                        
						<img src="../img/cart.svg" width="30" height="30" >
						<small class="ml-2">Корзина</small>
                    </a>
                </li>
                <li class="nav-item d-flex ">
                    <a class="nav-link d-flex flex-column align-items-center" href="../favorite.php">                        
						<img src="../img/favorite.svg" width="30" height="30" >
						<small class="ml-2">Избранное</small>
                    </a>
                </li>
                <li class="nav-item d-flex ">
                    <a class="nav-link d-flex flex-column align-items-center" href="../orders.php">                        
						<img src="../img/orders.svg" width="30" height="30" >
						<small class="ml-2">Заказы</small>
                    </a>
                </li>                
            </ul>
        </div>
    </div>
</nav>
    </header>
    <main>
	<div class="container py-5 px-5 contnt">
    <div class="row">

        <!--  Left Column -->
        <div class="col-md-8">
            <!-- Photo Section -->
			<div class="row">
            <div class="main-photo mb-3 col-md-8">
                <img id="mainPhoto" src="../image/<?= $images[0]['name'] ?? 'default.jpg' ?>" alt="Main Product Photo">
            </div>
            <div class="product-gallery d-flex flex-column gap-2 mb-3 col-md-3 ">
            <?php foreach ($images as $image): ?>
                <img src="../image/<?= $image['name'] ?>" alt="Photo <?= $image['name'] ?>" onclick="updateMainPhoto(this.src)" >
            <?php endforeach; ?>
            </div>
			</div>

            <!-- Characteristics Section -->			
			<h2 class="h5 ">Описание: </h2><p class=""><?= htmlspecialchars($product['description'] ?? '') ?></p>
            <h2 class="h5 mt-3">Характеристики</h2>
            <table class="table table-bordered">
                <tbody>
                    <tr><th>Материал</th><td><?= htmlspecialchars($product['material_name'] ?? '') ?></td></tr>
                    <tr><th>Основной цвет</th><td><?= htmlspecialchars($product['color_name'] ?? '') ?></td></tr>
                    <tr><th>Гарантия</th><td><?= htmlspecialchars($product['warranty'] ?? '') ?> года</td></tr>
                    <tr><th>Высота</th><td><?= htmlspecialchars($product['height'] ?? '') ?> см</td></tr>
                    <tr><th>Ширина</th><td><?= htmlspecialchars($product['width'] ?? '') ?> см</td></tr>
                    <tr><th>Длина</th><td><?= htmlspecialchars($product['length'] ?? '') ?> см</td></tr>
                    <tr><th>Тип</th><td><?= htmlspecialchars($product['furniture_type_name'] ?? '') ?></td></tr>
                    <tr><th>Подтип</th><td><?= htmlspecialchars($product['furniture_subtype_name'] ?? '') ?></td></tr>

                    <tr><th>Количество полок</th><td><?= htmlspecialchars($product['shelf_count'] ?? '') ?></td></tr>
                    <tr><th>Количество ящиков</th><td><?= htmlspecialchars($product['drawer_count'] ?? '') ?></td></tr>
                </tbody>
            </table>
        </div>
		<!-- Right Column -->
        <div class="col-md-4">
			<div class="card p-2 mb-3 lavand-2">
            <h1 class="h4 mb-2"><?= htmlspecialchars($product['product_name'] ?? '') ?></h1>
            <p class="mb-2"><strong>Артикул: </strong><?= htmlspecialchars($product['sku'] ?? '') ?></p>
            <p class="mb-1"><strong>Цена: </strong><?= htmlspecialchars($product['price'] ?? '') ?> ₽</p>
            </div>
            <button class="btn btn-2 w-100 mb-3" id="add-to-favorites" data-product-id="<?= $product['product_id'] ?>">Добавить в избранное</button>

			
            <div class="mb-2">
                <button class="btn btn-main-1 w-100 mb-3" id="add-to-cart" data-product-id="<?= $product['product_id'] ?>">Добавить в корзину</button>
                <button class="btn btn-main-1 w-100 mb-2" id="add-to-cart" data-product-id="<?= $product['product_id'] ?>">Редактировать товар</button>
                <div class="d-flex justify-content-between align-items-center w-100">

	<!-- Right  <div class="input-group w-100">
					<button class="btn btn-outline-secondary" type="button" id="decrease-quantity">-</button>
					<input type="number" id="quantity" class="form-control text-center" min="0" value="0">
					<button class="btn btn-outline-secondary" type="button" id="increase-quantity">+</button>
				</div>
                </div>
            </div>-->				
			
		

			
			
		</div>
        </div>
		
    </div>
  
	</main>
    <footer class="cl-dark  text-white py-2  ">
  <div class="container-xl pt-1 contnt1 ">
    <div class=" d-flex justify-content-between">
      <div class="  ">
 
        <p class="mb-1">г. Москва, Ходынский бульвар, д. 4 </p>
        <a href="#" class="text-white me-3 text-decoration-none"><i class="bi bi-twitter"></i> </a>
        <a href="#" class="text-white me-3 text-decoration-none"><i class="bi bi-whatsapp"></i> </a>
      </div>
      <div class=" ">
 

      </div>
      <div class=" ">
        <p class="mb-1">+7 (925) 469-35-46</p>
        <p class="mb-1">valley_shelves@yandex.ru</p> 

      </div>
    </div>
    <hr class="my-1">
    <div class="text-center">
      &copy; ДолинаПолок 2025
    </div>
  </div>
</footer> 

	<script src="../script/card.js"></script>
  </body>
</html>