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

            $query="SELECT
            price,
            quantity      
            FROM
            public.user u
            JOIN
            carted_product ON carted_product.user_id = u.id
            JOIN
            public.product p ON p.id = carted_product.product_id
            WHERE u.id = :user_id;";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $totalSum = 0;
            foreach ($products as $product) {
                $totalSum += $product['price'] * $product['quantity'];
            }




    //http_response_code(200);

} catch (Exception $e) {
    echo($e->getMessage());
    //http_response_code(500);
    //echo json_encode([ 'message' => 'Ошибка подключения к базе данных:'. $e->getMessage()]);    
}
} else {       
}
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Checkout</title>

	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../styles/index.css">
	<link rel="stylesheet" type="text/css" href="../styles/color.css">   
  </head>
  <body>
	<header>
    </header>
<main>
    <div class="container contnt1 mt-5">
		<div class="row justify-content-center">
        <h2 class="col-md-11 mb-4 ">Оформление Заказа</h2>
		</div>       

        <div class="row justify-content-center">
            <!-- Первая область -->
            <div class="col-md-6 card bg-blue">
			<div class="p-2 pt-3 ">
                <div class="alert alert-info" role="alert">
                    Проверьте корректность данных:
                </div> 

                <div class="mb-3">
                    <label for="phone" class="form-label">Телефон:</label>
                    <input type="text" id="phone" class="form-control" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" disabled>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Адрес:</label>
                    <input type="text" id="address" class="form-control" value="<?= htmlspecialchars($user['address'] ?? '') ?>" disabled>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Имя:</label>
                    <input type="text" id="name" class="form-control" value="<?= htmlspecialchars($user['name'] ?? '') ?>" disabled>
                </div>

                <div class="mb-3">
                    <label for="surname" class="form-label">Фамилия:</label>
                    <input type="text" id="surname" class="form-control" value="<?= htmlspecialchars($user['surname'] ?? '') ?>" disabled>
                </div>

                <div class="mb-3">
                    <label for="patronymic" class="form-label">Отчество:</label>
                    <input type="text" id="patronymic" class="form-control" value="<?= htmlspecialchars($user['patronymic'] ?? '') ?>" disabled>
                </div>
                <div class="text-end mb-2">
                    <a href="../pages/red_profile.php" class="btn btn-2">Редактировать профиль</a>
                </div>
            </div>
			</div>

            
             <!-- Вторая область -->
            <div class="col-md-5">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body blue-1 ">
                        

                        <div class="mb-3">
                            <!--  <label for="totalPrice" class="form-label">Итого:</label>
                            <input type="text" id="totalPrice" class="form-control" value="1₽" disabled> -->
                            <p class="card-text"><strong>Итого: </strong><span id="total-sum"><?= htmlspecialchars($totalSum ?? '') ?></span> ₽</p>
                        </div>


                        <div class="text-center mt-4 ">
                            <button class="btn btn-main-1 btn-lg px-5 w-100">Заказать</button>
                        </div>
                    </div>
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
	<script src="../script/checkout.js"></script>
  </body>
</html>