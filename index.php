<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>main</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="styles/index.css">
	<link rel="stylesheet" type="text/css" href="styles/color.css">   
  </head>
  <body>
	<header>
	<nav class="navbar navbar-expand-lg navbar-light  lavand-1">
    <div class="container-xl pt-2 contnt1">
        <!-- Логотип -->
        <a class="navbar-brand" href="#">
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
                    <a class="nav-link d-flex flex-column align-items-center" href="pages/registr.php">
                        <img src="img/user.svg" width="30" height="30" alt="User Icon">       
                    <small class="ml-2">Профиль</small>
                    </a>	
                </li>
                <li class="nav-item d-flex ">
                    <a class="nav-link d-flex flex-column align-items-center" href="pages/shopping_cart.php">                        
						<img src="img/cart.svg" width="30" height="30" >
						<small class="ml-2">Корзина</small>
                    </a>
                </li>
                <li class="nav-item d-flex ">
                    <a class="nav-link d-flex flex-column align-items-center" href="pages/favorite.php">                        
						<img src="img/favorite.svg" width="30" height="30" >
						<small class="ml-2">Избранное</small>
                    </a>
                </li>
                <li class="nav-item d-flex ">
                    <a class="nav-link d-flex flex-column align-items-center" href="pages/orders.php">                        
						<img src="img/orders.svg" width="30" height="30" >
						<small class="ml-2">Заказы</small>
                    </a>
                </li>                
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Фильтрация</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Название</label>
                                <input type="text" class="form-control" name="name">
                            </div>                            
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Артикул</label>
                                <input type="text" class="form-control" name="sku">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Цена</label>
                                <div class="d-flex">
                                    <input type="number" class="form-control me-2" placeholder="От"  name="price_from">
                                    <input type="number" class="form-control" placeholder="До"  name="price_to">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Материал</label>
                                <input type="text" class="form-control"  name="material">
                            </div>                            
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Цвет</label>
                                <input type="text" class="form-control"  name="color">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Высота см</label>
                                <div class="d-flex">
                                    <input type="number" class="form-control me-2" placeholder="От"  name="height_from">
                                    <input type="number" class="form-control" placeholder="До"  name="height_to">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Ширина см</label>
                                <div class="d-flex">
                                    <input type="number" class="form-control me-2" placeholder="От"  name="width_from">
                                    <input type="number" class="form-control" placeholder="До"  name="width_to">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Длина см</label>
                                <div class="d-flex">
                                    <input type="number" class="form-control me-2" placeholder="От"  name="length_from">
                                    <input type="number" class="form-control" placeholder="До"  name="length_to">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Тип мебели</label>
                                <input type="text" class="form-control"  name="furniture_type">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Подтип мебели</label>
                                <input type="text" class="form-control"  name="furniture_subtype">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Количество полок</label>                               
                                <input type="number" class="form-control "   name="shelf_count">                           
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Количество ящиков</label>                                
                                <input type="number" class="form-control"  name="drawer_count">                                
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-main-1">Найти</button>
                </div>
            </div>
        </div>
    </div>

    </header>
    <main>
	    <div class="container py-4 contnt1">
        <!--
        <h1 class="text-center mb-4"></h1>-->

        <!-- Продуктовая сетка -->
        <div id="product-grid" class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
            <!-- Карты -->
        </div>

        <!-- нумерация страниц -->
        <nav class="mt-4">
            <ul class="pagination justify-content-center" id="pagination">
                <li class="page-item">
                    <button class="page-link bg-blue " id="prev-page">&laquo;</button>					
                </li>
                <!--  номера страниц  -->
                <li class="page-item">
                    <button class="page-link bg-blue" id="next-page">&raquo;</button>
                </li>
            </ul>
        </nav>
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


	<script src="script/index.js"></script>
  </body>
</html>

