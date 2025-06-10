<?php 
$method = $_SERVER['REQUEST_METHOD'];


if ($method === 'GET') {
  
    $request_id = $_GET['id'] ?? null;
    $request_id = 2;

    if ($request_id) {
        

        try {
            $pdo = new PDO('pgsql:host=localhost;port=5433;dbname=valleyb', "mainuser", "Town56Mercury");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = "SELECT
                       u.id AS user_id,                 
                       u.name AS user_name,
                       u.surname AS user_surname,
                       u.phone AS phone,
                       rq.status_id AS status_id,
                       s.name AS status_name,
                       s.description AS status_description,
                       rq.description AS rq_description,
                       rq.creation_date AS creation_date,
                       rq.closing_date AS closing_date                        
                    FROM                
                        request rq
                    JOIN
                        public.user u ON rq.user_id = u.id
                    JOIN
                        request_status s ON rq.status_id = s.id
                         
                    WHERE 
                        rq.id = :request_id;";



$stmt = $pdo->prepare($query);
$stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
$stmt->execute();

$request = $stmt->fetch();


$query = "SELECT
                desig.id AS id,
                desig.name AS name,
                desig.surname AS surname,
                desig.phone AS phone
            FROM
                public.user desig
            JOIN
                request rq ON rq.designer_id = desig.id
            WHERE
                rq.id = :request_id;";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
$stmt->execute();
$designer = $stmt->fetch();


        $creationDate = new DateTime($request['creation_date']);
        $formattedCreationDate = $creationDate->format('Y-m-d H:i');
        if($request['closing_date']){
        $closing_date = new DateTime($request['closing_date']) ;
        $formatted_closing_date = $closing_date->format('Y-m-d H:i');}

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
    <title>reqest</title>

	
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

            <!-- Ссылки на личный кабинет и корзину <span class="ml-2">Профиль</span> -->
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

        
        <div class="col-md-8">
        <h2 class=" " >Заявка</h2>
                      
 

            			
			<h2 class="h5 ">Описание: </h2><p class=""><?= htmlspecialchars($request['rq_description'] ?? '') ?></p>
        <div class="d-flex justify-content-start align-items-center mb-2">
            <small class="card p-1 me-3"><?= htmlspecialchars($request['status_description'] ?? '') ?></small>
            <small class="text-muted me-3">Дата создания: <?= htmlspecialchars($formattedCreationDate ?? '') ?></small>
            <small class="text-muted"> Дата завершения: <?= htmlspecialchars($formatted_closing_date ?? '') ?> </small>
        </div>
            <table class="table table-bordered">
                <tbody>
                    <tr><th>Дизайнер</th><td><?= htmlspecialchars($designer['name'] ?? '') ?> <?= htmlspecialchars($designer['surname'] ?? '') ?></td></tr>
                    <tr><th>Телефон дизайнера</th><td>+<?= htmlspecialchars($designer['phone'] ?? '') ?></td></tr>
                    <tr><th>Клиент</th><td><?= htmlspecialchars($request['user_name'] ?? '') ?> <?= htmlspecialchars($request['user_surname'] ?? '') ?></td></tr>
                    <tr><th>Телефон клиента</th><td>+<?= htmlspecialchars($request['phone'] ?? '') ?></td></tr>
                </tbody>
                
            </table>

            <div class="card card-body mb-3">
            <h5 class="h5 ">Прикрепить товар </h5><p class=""><?= htmlspecialchars($request['description'] ?? '') ?></p>
            <form id="tovarForm">
                            <div class="mb-1 ">
                                <label for="login" class="form-label">ID товара</label>
                                <input type="text" class="form-control mb-2" id="login" placeholder="Логин" name="login" required>
                                <button type="submit" class="btn w-100" style="background-color: #655CAB; color: white">Прикрепить</button>
                            </div>

                            
                                
                            
                        </form>
                        </div> 
            <h2 class="h5 ">Товары </h2><p></p>              
        </div>
		
        <div class="col-md-4">
			<div class="card p-2 mb-3 lavand-2">
            <h2 class="h5 ">Сумма: 0</h2><p></p>
            </div>
            <button class="btn btn-2 mb-3 w-100">Отказаться</button>		
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