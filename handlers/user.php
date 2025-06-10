<?php

// регистрация
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
header('Content-Type: application/json');

$input = file_get_contents('php://input');
$data = json_decode($input, true);


if (json_last_error() === JSON_ERROR_NONE) {
    $login = $data['login'] ?? null;
    $name = $data['name'] ?? null;
    $surname = $data['surname'] ?? null;
    $patronymic = $data['patronymic'] ?? null;
    $phone = $data['phone'] ?? null;
    $address = $data['address'] ?? null;
    $password = $data['password'] ?? null;



     
    if ($login && $name && $surname && $patronymic && $phone && $address && $password) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        try {
            $conn = pg_connect("host=localhost port=5433 dbname=valleyb user=mainuser password=Town56Mercury");
            $sql = "SELECT login FROM public.user WHERE login = $1";
            $result = pg_query_params($conn, $sql, array($login));

            if (pg_num_rows($result) > 0) {
                http_response_code(400);
                echo json_encode(['message' => "Пользователь с таким логином уже существует"]);
                exit;
            }
       
            $sql = "INSERT INTO public.user (login, name, surname, patronymic, phone, address, password) VALUES ($1, $2, $3, $4, $5, $6, $7)";
            $result = pg_query_params($conn, $sql, array($login, $name, $surname, $patronymic, $phone, $address, $hashed_password));

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


//редактирование профиля
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    header('Content-Type: application/json ');
    http_response_code(200);

    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if (json_last_error() === JSON_ERROR_NONE) {
        //$login = $data['login'] ?? null;
        $name = $data['name'] ?? null;
        $surname = $data['surname'] ?? null;
        $patronymic = $data['patronymic'] ?? null;
        $phone = $data['phone'] ?? null;
        $address = $data['address'] ?? null;


        $user_id =22;    
        if ($name && $surname && $patronymic && $phone && $address ) {
            
            try {
                $conn = pg_connect("host=localhost port=5433 dbname=valleyb user=mainuser password=Town56Mercury");
                $sql = "SELECT name FROM public.user WHERE id = $1;";
                $result = pg_query_params($conn, $sql, array($user_id));
    
                if (pg_num_rows($result) == 0) {
                    http_response_code(400);
                    echo json_encode(['message' => "Пользователь не существует"]);
                    exit;
                }
           
                $sql = "UPDATE public.user 
                SET name = $1,
                surname = $2,
                patronymic = $3,
                phone = $4,
                address = $5
                WHERE id = $6;";
                $result = pg_query_params($conn, $sql, array($name, $surname, $patronymic, $phone, $address, $user_id));
    
                pg_close($conn);


                
                http_response_code(200);
                echo json_encode(['message' => 'http://valley.ru/pages/profile.php']);       
                
    
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