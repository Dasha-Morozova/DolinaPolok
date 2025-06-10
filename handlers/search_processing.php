<?php 
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);


$input = file_get_contents('php://input');
$data = json_decode($input, true);


if (json_last_error() === JSON_ERROR_NONE) {

    $name = $data['name'] ?? null;
    $sku = $data['sku'] ?? null;
    $price_from = $data['price_from'] ?? null;
    $price_to = $data['price_to'] ?? null;
    $material = $data['material'] ?? null;
    $color = $data['color'] ?? null;
    $height_from = $data['height_from'] ?? null;
    $height_to = $data['height_to'] ?? null;
    $width_from = $data['width_from'] ?? null;
    $width_to = $data['width_to'] ?? null;
    $length_from = $data['length_from'] ?? null;
    $length_to = $data['length_to'] ?? null;
    $furniture_type = $data['furniture_type'] ?? null;
    $furniture_subtype = $data['furniture_subtype'] ?? null;
    $shelf_count = $data['shelf_count'] ?? null;
    $drawer_count = $data['drawer_count'] ?? null;
    
    


try {
    $pdo = new PDO('pgsql:host=localhost;port=5433;dbname=valleyb', "mainuser", "Town56Mercury");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $params = [];
$query = "SELECT
            p.id AS product_id,
            p.name AS product_name,
            p.price AS price,
            m.name AS material_name,
            c.name AS color_name,
            ft.name AS furniture_type_name,
            fst.name AS furniture_subtype_name,
            i.id AS image_id,
            i.name AS image_name

        FROM
            public.product p
        JOIN
            material m ON p.material_id = m.id
        JOIN
            color c ON p.color_id = c.id
        JOIN
            furniture_type ft ON p.furniture_type_id = ft.id
        JOIN
            furniture_subtype fst ON p.furniture_subtype_id = fst.id
        LEFT JOIN
        (SELECT
         i.id,         
         i.product_id,
         i.name,
         ROW_NUMBER() OVER (PARTITION BY i.product_id ORDER BY i.id) AS rn
        FROM
         public.image i) i ON p.id = i.product_id AND i.rn = 1
        WHERE 1=1";

if ($name) {
    $query .= " AND p.name LIKE :name";
    $params[':name'] = "%$name%";
}

if ($sku) {
    $query .= " AND p.sku = :sku";
    $params[':sku'] = $sku;
}

if ($price_from) {
    $query .= " AND p.price >= :price_from";
    $params[':price_from'] = $price_from;
}

if ($price_to) {
    $query .= " AND p.price <= :price_to";
    $params[':price_to'] = $price_to;
}

if ($material) {
    $query .= " AND m.name = :material";
    $params[':material'] = $material;
}

if ($color) {
    $query .= " AND c.name = :color";
    $params[':color'] = $color;
}

if ($height_from) {
    $query .= " AND p.height >= :height_from";
    $params[':height_from'] = $height_from;
}

if ($height_to) {
    $query .= " AND p.height <= :height_to";
    $params[':height_to'] = $height_to;
}

if ($width_from) {
    $query .= " AND p.width >= :width_from";
    $params[':width_from'] = $width_from;
}

if ($width_to) {
    $query .= " AND p.width <= :width_to";
    $params[':width_to'] = $width_to;
}

if ($length_from) {
    $query .= " AND p.length >= :length_from";
    $params[':length_from'] = $length_from;
}

if ($length_to) {
    $query .= " AND p.length <= :length_to";
    $params[':length_to'] = $length_to;
}

if ($furniture_type) {
    $query .= " AND ft.name = :furniture_type";
    $params[':furniture_type'] = $furniture_type;
}

if ($furniture_subtype) {
    $query .= " AND fst.name = :furniture_subtype";
    $params[':furniture_subtype'] = $furniture_subtype;
}

if ($shelf_count) {
    $query .= " AND p.shelf_count = :shelf_count";
    $params[':shelf_count'] = $shelf_count;
}

if ($drawer_count) {
    $query .= " AND p.drawer_count = :drawer_count";
    $params[':drawer_count'] = $drawer_count;
}


$stmt = $pdo->prepare($query);
$stmt->execute($params);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

http_response_code(200);
echo json_encode([ 'message' => $results]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([ 'message' => 'Ошибка подключения к базе данных:'. $e->getMessage()]);
    
}
} else {
    http_response_code(400);
    echo json_encode([ 'message' => 'Ошибка отправки.']);
    
}

?>