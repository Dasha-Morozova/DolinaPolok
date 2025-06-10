<?php

$user_id = 22;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
header('Content-Type: application/json');

$input = file_get_contents('php://input');
$data = json_decode($input, true);


if (json_last_error() === JSON_ERROR_NONE) {
    $phone = $data['phone'] ?? null;  
    $name = $data['name'] ?? null;
    $surname = $data['surname'] ?? null;  
    $description = $data['description'] ?? null;
 
    if ($phone && $name && $surname) {
        

        
        try {
            $conn = pg_connect("host=localhost port=5433 dbname=valleyb user=mainuser password=Town56Mercury");

       
            $sql = "INSERT INTO request (user_id, creation_date, description) VALUES ($1, NOW(), $2)";
            $result = pg_query_params($conn, $sql, array($user_id, $description));

            #$sql = "INSERT INTO request (login, name, surname, patronymic, phone, address, password) VALUES ($1, $2, $3, $4, $5, $6, $7)";
            #$result = pg_query_params($conn, $sql, array($login, $name, $surname, $patronymic, $phone, $address, $hashed_password));
            pg_close($conn);
            http_response_code(200);

            echo json_encode(['message' => 'http://valley.ru/index.php']);       
            exit();

        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode([ 'message' => 'Ошибка подключения к базе данных:'. $e->getMessage()]);
            
        }

    } else {
        
        http_response_code(400);
        echo json_encode([ 'message' => "Неверные данные"]);
        
    }
} else {

    http_response_code(400);
    echo json_encode([ 'message' => 'Ошибка отправки.']);
    
}
}
?>