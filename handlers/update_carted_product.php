<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
header('Content-Type: application/json');
http_response_code(200);    
    $data = json_decode(file_get_contents('php://input'), true);
    $product_id = (int)$data['product_id'] ?? null;
    $quantity = (int)$data['quantity'] ?? null;
    $user_id = 22;

    if ($product_id && $user_id && $quantity) {


        try {
            $pdo = new PDO('pgsql:host=localhost;port=5433;dbname=valleyb', "mainuser", "Town56Mercury");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



            $query ="UPDATE carted_product
                     SET quantity = :quantity WHERE product_id = :product_id and user_id = :user_id";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            

} catch (Exception $e) {
    echo($e->getMessage());

    http_response_code(500);
    echo json_encode([ 'message' => 'Ошибка подключения к базе данных:'. $e->getMessage()]);
    
}

        echo json_encode([ 'success' => true,'message' => 'Товар добавлен в корзину']);
            
    } else {
        echo json_encode(['success' => false, 'message' => 'Не указан ID товара']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Недопустимый метод запроса']);
}


if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    header('Content-Type: application/json');
    http_response_code(200); 
    parse_str($_SERVER['QUERY_STRING'], $queryParams);
    $product_id = isset($queryParams['product_id']) ? intval($queryParams['product_id']) : null;
    $user_id = 22;

    if ($product_id) {
  


        try {
            $pdo = new PDO('pgsql:host=localhost;port=5433;dbname=valleyb', "mainuser", "Town56Mercury");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $query ="DELETE FROM carted_product WHERE product_id = :product_id and user_id = :user_id";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            
} catch (Exception $e) {
    echo($e->getMessage());

    http_response_code(500);
    echo json_encode([ 'message' => 'Ошибка подключения к базе данных:'. $e->getMessage()]);
    
}
        
        echo json_encode([ 'success' => true,'message' => 'Товар удален']);
           
    } else {
        echo json_encode(['success' => false, 'message' => 'Не указан ID товара']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Недопустимый метод запроса']);
}




?>