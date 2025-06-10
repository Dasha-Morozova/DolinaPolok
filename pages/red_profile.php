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
    <title>Redaction profile</title>

	
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
		<h2 class="col-md-7 " >Редактирование профиля</h2>
		</div>	
        <div class="row justify-content-center">
		<div class="col-md-7 card bg-blue">
		<div class="card-body ">

		
        <form class=" " id="updateUserForm">
		

            <div class="mb-3">
                <label for="phone" class="form-label">Телефон</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" placeholder="Введите ваш телефон">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Адрес</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($user['address'] ?? '') ?>" placeholder="Введите ваш адрес">
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" placeholder="Введите ваше имя">
            </div>

            <div class="mb-3">
                <label for="surname" class="form-label">Фамилия</label>
                <input type="text" class="form-control" id="surname" name="surname" value="<?= htmlspecialchars($user['surname'] ?? '') ?>" placeholder="Введите вашу фамилию">
            </div>

            <div class="mb-3">
                <label for="patronymic" class="form-label">Отчество</label>
                <input type="text" class="form-control" id="patronymic" name="patronymic" value="<?= htmlspecialchars($user['patronymic'] ?? '') ?>" placeholder="Введите ваше отчество">
            </div>

            <button type="submit" class="btn btn-main-1 w-100 mb-3">Сохранить изменения</button>
        </form>
		</div>
		</div>
    </div>
	</div>	

	</main>
    <footer>
    </footer>

	<script src="../script/red_profile.js"></script>
  </body>
</html>