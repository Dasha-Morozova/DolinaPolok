<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration</title>

	
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
	    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center lavand-1">
                        <h3>Регистрация</h3>
                    </div>
                    <div class="card-body lavand-2 ">
                        <div class="text-center ">
                                Уже есть аккаунт? <a href="login.html" class="text-decoration-none">Войти</a>
                        </div>
                        <form id="registrationForm">
                            
                            <div class="mb-3">
                                <label for="login" class="form-label">Логин</label>
                                <input type="text" class="form-control" id="login" placeholder="Логин" autocomplete="off" name="login" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Имя</label>
                                <input type="text" class="form-control" id="name" placeholder="Имя" autocomplete="given-name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="surname" class="form-label">Фамилия</label>
                                <input type="text" class="form-control" id="surname" placeholder="Фамилия" autocomplete="family-name" name="surname" required>
                            </div>
                            <div class="mb-3">
                                <label for="patronymic" class="form-label">Отчество</label>
                                <input type="text" class="form-control" id="patronymic" placeholder="Отчество"  autocomplete="additional-name"  name="patronymic" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Телефон</label>
                                <input type="tel" class="form-control" id="phone" placeholder="Телефон" autocomplete="tel" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Адрес</label>
                                <input type="text" class="form-control" id="address" placeholder="Адрес" autocomplete="address" name="address" required>
                            </div>                                                                                  
                            <div class="mb-3">
                                <label for="password" class="form-label">Пароль</label>
                                <input type="text" class="form-control" id="password" placeholder="Придумайте пароль" autocomplete="off" name="password" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-main-1">Зарегистрироваться</button>
                            </div>
                        </form>
                        						
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

	<script src="../script/registr.js"></script>
  </body>
</html>