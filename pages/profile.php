<?php 

$user_id = 22;


    if (TRUE) {
        

        try {
            $pdo = new PDO('pgsql:host=localhost;port=5433;dbname=valleyb', "mainuser", "Town56Mercury");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query="SELECT
                    login , 
                    password,
                    phone,
                    address,
                    name,
                    surname,
                    patronymic,
                    is_admin      
                FROM
                    public.user u
                WHERE u.id = :user_id;";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch();

} catch (Exception $e) {
    echo($e->getMessage());

}
} else {       
}
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile</title>

	
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
    <main>

    <div class="container contnt1 mt-5 ">
		<div class="row justify-content-center">
		<h2 class="col-md-10 " >Личный кабинет</h2>
		</div>
        <div class="row justify-content-center">
		
           
            <div class="col-md-6 ">
                
                <ul class="list-group bg-blue">
                    <li class="list-group-item bg-blue"><strong>Логин: </strong><?= htmlspecialchars($user['login'] ?? '') ?></li>
                    <li class="list-group-item bg-blue"><strong>Телефон: </strong><span id="phone" ><?= htmlspecialchars($user['phone'] ?? '') ?></span></li>
                    <li class="list-group-item bg-blue"><strong>Адрес: </strong><?= htmlspecialchars($user['address'] ?? '') ?></li>
                    <li class="list-group-item bg-blue"><strong>Имя: </strong><?= htmlspecialchars($user['name'] ?? '') ?></li>
                    <li class="list-group-item bg-blue"><strong>Фамилия: </strong><?= htmlspecialchars($user['surname'] ?? '') ?></li>
                    <li class="list-group-item bg-blue"><strong>Отчество: </strong><?= htmlspecialchars($user['patronymic'] ?? '') ?></li>
                </ul>
            </div>
       
            <div class="col-md-4 d-flex flex-column align-items-start ">
                <div class="card">
                    <div class="card-body lavand-2">
                <a href="../pages/red_profile.php">
                <button class="btn btn-main-1 mb-3 w-100"  >Редактировать профиль</button>
                </a>
                


                <a href="../pages/red_reqest.php">
                     <button class="btn  btn-2 mb-3 w-100"  >Выбрать мебель вместе с дизайнером</button>
                </a>
                <a href="../pages/red_profile.php">
                <button class="btn  btn-2  w-100"  >Заявки</button>
                </a>                 
                </a>                
                             
                <!--<a href="../pages/red_profile.php">
                <button class="btn btn-main-1 mb-3 w-100"  >Добавить товар</button>
                </a>
                <a href="../pages/red_profile.php">
                <button class="btn btn-main-1 mb-3 w-100"  >Добавить дизайнера</button>
                </a>
                                <a href="../pages/red_profile.php">
                <button class="btn btn-main-1  w-100"  >Дизайнеры</button>
                </a> --> 
                    
 
                </div>
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

	<script src="../script/profile.js"></script>
  </body>
</html>