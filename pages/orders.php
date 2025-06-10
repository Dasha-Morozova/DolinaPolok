<?php
$product = array(
    'product_name' => 'Шкаф Линт',
    'product_id' => 2,
    'sku' => '123123',
    'price' => '10 999',
    'quantity' => '1',
	
	'material' => 'Дуб',
    'room' => 'Гостиная',
    'color' => 'Белый',
    'warranty' => '2',
    'height' => '180',
    'width' => '80',
    'length' => '40',
    'case_thickness' => '3.5',
    'furniture_type' => 'Шкаф',
    'facade_type' => 'Закрытый',
    'door_type' => 'Распашные',
    'handle_type' => 'Металлические',
    'shelf_count' => 5,
    'drawer_count' => 3,
	'description' => 'Мебельное изделие, предназначенное для хранения одежды.'


);
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Заказы</title>

	
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



<div class="mt-4">
    <div class="mb-3 ">
        <h2 class="text_drk_lv me-3">Заказы</h2>
        <label for="statusFilter" class="form-label fw-bold mb-0 me-2 mb-1">Фильтр по статусу:</label>
        <select id="statusFilter" class="form-select " onchange="filterRequests()">
            <option value="all">Все</option>
            <option value="in-process">В процессе</option>
            <option value="completed">Завершенные</option>
        </select>
    </div>
    <div class="container">
<div class="row" id="requests">

    <!-- Карточка "В процессе" -->
    
    <div class="card request_card bg-blue mb-3 me-0" data-status="in-process">
        <div class=" card-body d-flex justify-content-between align-items-center    ">
        <div class="d-flex justify-content-start align-items-center">
                       

            <p class="card-text mb-0 me-2">Сумма: 6400.00</p>

            <p class="card-text mb-0 me-2">Номер: 383293639</p>
            <small class="text-muted me-2">Дата создания: 2025.03.30</small>             
        </div>
        <span class="badge   me-2 card text-dark float-right">В процессе</span>
        </div>
        <!--  ?php foreach ($products as $product): ?> -->
            <div class="card mb-3 p-2 px-3 " id="cart-item-1">
                <div class="row g-0 ">
                    <div class="col-md-2 my-auto ">
                        <img src="../image/1.jpg<?php #echo htmlspecialchars($product['image_name']); ?>" class="img-fluid rounded " alt="img">
                    </div>
                    <div class="col-md-10 ">
                    
                        <div class="card-body m-2 ">
						
                            <h5 class="card-title "><?php echo htmlspecialchars($product['product_name']); ?></h5>
							<p class="card-text "><strong></strong><?php #echo htmlspecialchars($product['price']); ?>6400 ₽</p>
                            <p class="card-text "><strong>Количество: </strong><?php echo htmlspecialchars($product['quantity']); ?></p>
							<!-- <div class="  d-flex justify-content-between align-items-center"><div></div>
                            <button class="btn btn-main-1  w-33 ?-?-product" data-product-id="<?= $product['product_id'] ?>">Написать отзыв</button>
							</div>-->                           
                        
						</div>

                       
					</div>
                    

		
                </div>
            </div>
       
			
             <!-- ?php endforeach; ?> -->
    </div>
    

    <!-- Карточка "Выполнена" -->
     
    <div class="card request_card bg-blue mb-3 me-0" data-status="in-process">
        <div class=" card-body d-flex justify-content-between align-items-center    ">
        <div class="d-flex justify-content-start align-items-center">
                       

            <p class="card-text mb-0 me-2">Сумма: 4400.00</p>

            <p class="card-text mb-0 me-2">Номер: 526401383</p>
            <small class="text-muted me-2">Дата создания: 2025.03.24</small>             
        </div>
        <span class="badge   me-2 card text-dark float-right">Завершен</span>
        </div>
        <!--  ?php foreach ($products as $product): ?> -->
            <div class="card mb-3 p-2 px-3 " id="cart-item-1">
                <div class="row g-0 ">
                    <div class="col-md-2 my-auto ">
                        <img src="../image/2.jpg" class="img-fluid rounded " alt="img">
                    </div>
                    <div class="col-md-10 ">
                    
                        <div class="card-body m-2 ">
						
                            <h5 class="card-title ">Шкаф Турин</h5>
							<p class="card-text "><strong></strong>4400 ₽</p>
                            <p class="card-text "><strong>Количество: </strong>1</p>

					    </div>
                    </div> 
            	</div>

            </div>   
							<div class=" mb-2 d-flex justify-content-between align-items-center"><div></div>
                            <button class="btn btn-main-1   ?-?-product" data-product-id="<?= $product['product_id'] ?>">Отменить заказ</button>
							</div> 
    <!-- <div class="card request_card bg-blue mb-3 me-0" data-status="completed">
        <div class=" card-body d-flex justify-content-between align-items-center    ">
        <div class="d-flex justify-content-start align-items-center">
            

            <p class="card-text mb-0 me-2">Сумма: 6400.00</p>

            <p class="card-text mb-0 me-2">Номер: 291383257</p>
            <small class="text-muted me-2">Дата создания: 2025.03.28</small>            
        </div>
        <span class="badge   me-2 card text-dark float-right">Завершен</span>
          <button class="btn btn-main-1 btn-sm">Оплатить</button>   
        </div>
    </div>-->

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