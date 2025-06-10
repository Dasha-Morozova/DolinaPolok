<?php
header('Content-Type: application/json ');
error_reporting(E_ALL);
ini_set('display_errors', 1);


$input = file_get_contents('php://input');
$data = json_decode($input, true);



if (json_last_error() === JSON_ERROR_NONE) {
    $login = $data['login'] ?? null;
    $password = $data['password'] ?? null;

                

    if ($login && $password) {

        
        try {
            $conn = pg_connect("host=localhost port=5433 dbname=valleyb user=mainuser password=Town56Mercury");

            $sql = "SELECT login, id, password FROM public.user WHERE login = $1";
            $result = pg_query_params($conn, $sql, array($login));

            if (pg_num_rows($result) == 0) {
                http_response_code(400);
                echo json_encode(['message' => "Пользователя с таким логином не существует"]);
                exit;
            }
            $user = pg_fetch_assoc($result);


            if (password_verify($password, $user['password'])) {
                #session_start();              
                #$_SESSION['user_id'] = $user['id']; // Сохраняем ID пользователя в сессии                
                    
                http_response_code(200);
                echo json_encode(['message' => 'http://valley.ru/index.php']);                  
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Неверный пароль']);  
            }

       

            pg_close($conn);             
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




?>