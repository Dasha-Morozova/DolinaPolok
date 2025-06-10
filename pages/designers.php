<?php

        $this_user_id =22; //дизайнер user
  
        if (TRUE) {
            $is_designer = true ; //false true
            
    
            try {
                $pdo = new PDO('pgsql:host=localhost;port=5433;dbname=valleyb', "mainuser", "Town56Mercury");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = "SELECT
                       u.id AS user_id,                 
                       u.name AS user_name,
                       u.surname AS user_surname,
                       u.phone AS phone                       
                    FROM                
                        public.user u
                    WHERE u.is_designer = TRUE";

                        
    
    
    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    
    } catch (Exception $e) {
        echo($e->getMessage());
    
        
    }
    } else {
            echo "GET request received without param";
    }
    




?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Дизайнеры</title>

	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../styles/index.css">
	<link rel="stylesheet" type="text/css" href="../styles/color.css">
	<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
       
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



<div class="mt-4">
    <div class="mb-3 ">
        <h2 class=" text_drk_lv me-3">Дизайнеры</h2>
    </div>
</div>
<div class="container">
<div class="row" id="requests">

    <!-- В процессе -->

<?php foreach ($requests as $request): 
 ?>
           
    <div class="card bg-light mb-3  request_card " data-status="">
    <a class="text-decoration-none  text-reset lavand-1" href="request.php">     
        <div class="card-body m-2 d-flex justify-content-start align-items-center pb-0  ">
        <h5 class="card-title me-2"><?= htmlspecialchars($request['user_name'] ?? '') ?> <?= htmlspecialchars($request['user_surname'] ?? '') ?></h5>
        <p class="card-title me-2">+<?= htmlspecialchars($request['phone'] ?? '') ?></p>       
        </div>
     </a>

    </div>
    </a>
<?php endforeach; ?> 

</div>
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
    

	<script src="../script/user_requests.js"></script>
  </body>
</html>