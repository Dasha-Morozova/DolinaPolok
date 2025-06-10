<?php




      
 
        //$user_id = $_GET['id'] ?? null;
        $this_user_id =22; //дизайнер user
  
    
        if (TRUE) {
            $is_designer = false ; //false true
            
    
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
                        request_status s ON rq.status_id = s.id  ";

                        
                    if ($is_designer == true){
                        $query .=   "WHERE rq.designer_id = :this_user_id;";
                    } else {
                        $query .=  "WHERE rq.user_id = :this_user_id;";
                    }    
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':this_user_id', $this_user_id, PDO::PARAM_INT);
    $stmt->execute();

    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    
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
    <title>Заявки</title>

	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../styles/index.css">
	<link rel="stylesheet" type="text/css" href="../styles/color.css">
       
  </head>
  <body>
	<header>
    </header>
    <main class="">
<div class="container contnt1 mt-5 ">

<?= htmlspecialchars($requests['phone'] ?? '') ?>

<div class="mt-4">
    <div class="mb-3 ">
        <h2 class=" text_drk_lv me-3">Заявки</h2>
        <label for="statusFilter" class="form-label fw-bold mb-0 me-2 mb-1">Фильтр по статусу:</label>
        <select id="statusFilter" class="form-select " onchange="filterRequests()">
            <option value="all">Все</option>
            <option value="in process">В процессе</option>
            <option value="completed">Выполненные</option>
        </select>
    </div>
</div>
<div class="container">
<div class="row" id="requests">

    <!-- Карточка "В процессе" -->

<?php foreach ($requests as $request): 
        $creationDate = new DateTime($request['creation_date']);
        $formattedCreationDate = $creationDate->format('Y-m-d H:i');
        if($request['closing_date']){
        $closing_date = new DateTime($request['closing_date']) ;
        $formatted_closing_date = $closing_date->format('Y-m-d H:i');}
        ?>
           
    <div class="card bg-light mb-3 me-0 request_card" data-status="<?= htmlspecialchars($request['status_name'] ?? '') ?>">
    <a class="text-decoration-none  text-reset" href="request.php">     
        <div class="card-body mt-2 d-flex justify-content-start align-items-center pb-0 lavand-1 ">
        <h5 class="card-title me-2"><?= htmlspecialchars($request['user_name'] ?? '') ?> <?= htmlspecialchars($request['user_surname'] ?? '') ?></h5>
        <span class="badge  text-dark float-right"><?= htmlspecialchars($request['status_description'] ?? '') ?></span>
       
        </div>
     </a>
        <div class="card-body">

        <p class="card-text mb-0"><?= htmlspecialchars($request['rq_description'] ?? '') ?></p>
        <div class="d-flex justify-content-start align-items-center">
            <small class="text-muted me-3">Дата создания: <?= htmlspecialchars($formattedCreationDate ?? '') ?></small>
            <small class="text-muted"> Дата завершения: <?= htmlspecialchars($formatted_closing_date ?? '') ?> </small>
        </div>
        </div>
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