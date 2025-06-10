<?php
header('Content-Type: application/json');
http_response_code(200);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $product_id = (int)$data['product_id'] ?? null;
    $user_id = 22;

    if ($product_id) {
        
        //session_start(); // Начинаем сессию (если еще не начата)

        //if (!isset($_SESSION['cart'])) {
        //    $_SESSION['cart'] = []; // Создаем корзину, если ее нет
        //}

        // Добавляем товар в корзину
        //if (isset($_SESSION['cart'][$productId])) {
        //    $_SESSION['cart'][$productId] += 1; // Увеличиваем количество, если товар уже в корзине
        //} else {
        //    $_SESSION['cart'][$productId] = 1; // Добавляем товар в корзину
        //}

        try {
            $pdo = new PDO('pgsql:host=localhost;port=5433;dbname=valleyb', "mainuser", "Town56Mercury");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $query ="SELECT id FROM favorite_product WHERE user_id = :user_id AND product_id = :product_id;";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
            $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$existingProduct) {

            $query ="INSERT INTO favorite_product (user_id, product_id ) VALUES (:user_id, :product_id);";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
            }

        } catch (Exception $e) {
            echo($e->getMessage());

            //http_response_code(500);
            echo json_encode([ 'message' => 'Ошибка подключения к базе данных:'. $e->getMessage()]);
            
        }



       
        echo json_encode([ 'success' => true,'message' => 'Товар добавлен в избранное']);
            //'cart_count' => array_sum($_SESSION['cart']), // Общее количество товаров в корзине ]);
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
            
            $query ="DELETE FROM favorite_product WHERE product_id = :product_id and user_id = :user_id";

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
        //echo json_encode(['success' => false, 'message' => 'Не указан ID товара']);
    }
} else {
    //echo json_encode(['success' => false, 'message' => 'Недопустимый метод запроса']);
}


?>