<?php

        //$user_id = $_GET['id'] ?? null;
        $user_id =22;
    

        if (TRUE) {
            
    
            try {
                $pdo = new PDO('pgsql:host=localhost;port=5433;dbname=valleyb', "mainuser", "Town56Mercury");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = "SELECT
                        p.id AS product_id,
                        p.name AS product_name,
                        price,
                        i.id AS image_id,
                        i.name AS image_name
                                               
                    FROM 
                        public.user
                    JOIN
                    favorite_product ON favorite_product.user_id = public.user.id
                    JOIN
                    public.product p ON p.id = favorite_product.product_id
                    LEFT JOIN
                    (SELECT
                    i.id,         
                    i.product_id,
                    i.name,
                    ROW_NUMBER() OVER (PARTITION BY i.product_id ORDER BY i.id) AS rn
                    FROM
                    public.image i) i ON p.id = i.product_id AND i.rn = 1 

                    WHERE public.user.id = :user_id;";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    
    } catch (Exception $e) {
      

        
    }
    } 
    




?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Favorite</title>

	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../styles/index.css">
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

            <!-- Ссылки на личный кабинет и корзину  -->
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
    <main class="">
<div class="container contnt1 mt-5 ">
    <div class="row justify-content-center">
		<h2 class="col-md-9" >Избранное</h2>
        <div class="col-md-9">
        <?php foreach ($products as $product): ?> 
            <div class="card mb-3 px-3 " id="cart-item-1">
                <div class="row g-0 ">
                    <div class="col-md-2 my-auto ">
                        <img src="../image/<?php echo htmlspecialchars($product['image_name']); ?>" class="img-fluid rounded " alt="img">
                    </div>
                    <div class="col-md-10 ">
                    
                        <div class="card-body ">
						
                            <h5 class="card-title "><?php echo htmlspecialchars($product['product_name']); ?></h5>
							<p class="card-text "><strong></strong><?php echo htmlspecialchars($product['price']); ?>₽</p>
							<div class="row ">
								<div class="d-flex">

									<button class="btn btn-2  me-3 add-to-cart"  data-product-id="<?= $product['product_id'] ?>">В корзину</button>
									<button class="btn btn-danger  delete-favorite-product" data-product-id="<?= $product['product_id'] ?>">Удалить</button>

								</div>
							</div>                           
                        
						</div>

                       
					</div>
                    

		
                </div>
            </div>
			
            <?php endforeach; ?> 	
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

	<script src="../script/favorite.js"></script>
  </body>
</html>