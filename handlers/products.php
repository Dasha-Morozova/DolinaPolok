<?php 
$method = $_SERVER['REQUEST_METHOD'];


// получить товар products.php?id=3  
if ($method === 'GET') {
//header('Content-Type: application/json');
  

    $product_id = $_GET['id'] ?? null;


    if ($product_id) {
        echo "GET request received with id: $product_id";

        try {
            $pdo = new PDO('pgsql:host=localhost;port=5433;dbname=valleyb', "mainuser", "Town56Mercury");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
            $params = [];
            $query = "SELECT
                    p.id AS product_id,
                    p.name AS product_name,
                    sku,
                    price,
                    description,
                    warranty,
                    height,
                    width,
                    length,
                    shelf_count,
                    drawer_count,
                    m.name AS material_name,
                    c.name AS color_name,
                    ft.name AS furniture_type_name,
                    fst.name AS furniture_subtype_name
                    
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
                WHERE p.id = :p_id;";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':p_id', $product_id, PDO::PARAM_INT);
$stmt->execute();


$product = $stmt->fetch();


} catch (Exception $e) {
    echo($e->getMessage());

    http_response_code(500);
    echo json_encode([ 'message' => 'Ошибка подключения к базе данных:'. $e->getMessage()]);
    
}
} else {
        
}
}







//  запостить товар
elseif ($method === 'POST') {
    
header('Content-Type: application/json');
http_response_code(200);    
    //$data = json_decode(file_get_contents('php://input'), true);

    $data = json_decode($_POST['textData'], true);
    $product_name = $data['product_name'] ?? '';
    $sku = $data['sku'] ?? 0;
    $price = $data['price'] ?? 0;
    $description = $data['description'] ?? '';
    $warranty = $data['warranty'] ?? '';
    $height = $data['height'] ?? '';
    $width = $data['width'] ?? '';
    $length = $data['length'] ?? '';
    $shelf_count = $data['shelf_count'] ?? 0;
    $drawer_count = $data['drawer_count'] ?? 0;
    $material = $data['material'] ?? '';
    $color = $data['color'] ?? '';
    $furniture_type = $data['furniture_type'] ?? '';
    $furniture_subtype = $data['furniture_subtype'] ?? '';
    $storage_count = $data['storage_count'] ?? 0;
    
    $user_id = 22;
    $uploadDir = '../image/';
    
    if (TRUE) {

try {
$pdo = new PDO('pgsql:host=localhost;port=5433;dbname=valleyb', "mainuser", "Town56Mercury");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$material_id = null;
$color_id  = null;
$furniture_type_id = null;
$furniture_subtype_id = null;



if($material){
// Вставка материала, если он еще не существует
$stmt = $pdo->prepare("INSERT INTO material (name) VALUES (:name) ON CONFLICT (name) DO NOTHING RETURNING id");
$stmt->execute([':name' => $material]);
$material_id = $stmt->fetchColumn();
if ($material_id === false) {
    $stmt = $pdo->prepare("SELECT id FROM material WHERE name = :name");
    $stmt->execute([':name' => $material]);
    $material_id = $stmt->fetchColumn();
}}

if($color){
// Вставка цвета
$stmt = $pdo->prepare("INSERT INTO color (name) VALUES (:name) ON CONFLICT (name) DO NOTHING RETURNING id");
$stmt->execute([':name' => $color]);
$color_id = $stmt->fetchColumn();
if ($color_id === false) {
    $stmt = $pdo->prepare("SELECT id FROM color WHERE name = :name");
    $stmt->execute([':name' => $color]);
    $color_id = $stmt->fetchColumn();
}}
if($furniture_type){
// Вставка типа мебели
$stmt = $pdo->prepare("INSERT INTO furniture_type (name) VALUES (:name) ON CONFLICT (name) DO NOTHING RETURNING id");
$stmt->execute([':name' => $furniture_type]);
$furniture_type_id = $stmt->fetchColumn();
if ($furniture_type_id === false) {
    $stmt = $pdo->prepare("SELECT id FROM furniture_type WHERE name = :name");
    $stmt->execute([':name' => $furniture_type]);
    $furniture_type_id = $stmt->fetchColumn();
}}

if($furniture_subtype){
// Вставка подтипа мебели
$stmt = $pdo->prepare("INSERT INTO furniture_subtype (name) VALUES (:name) ON CONFLICT (name) DO NOTHING RETURNING id");
//"INSERT INTO furniture_subtype (name, furniture_type_id) VALUES (:name, :furniture_type_id) ON CONFLICT (name, furniture_type_id) DO NOTHING RETURNING id"
$stmt->execute([':name' => $furniture_subtype]);//, ':furniture_type_id' => $furniture_type_id
$furniture_subtype_id = $stmt->fetchColumn();
if ($furniture_subtype_id === false) {
    $stmt = $pdo->prepare("SELECT id FROM furniture_subtype WHERE name = :name");
    $stmt->execute([':name' => $furniture_subtype]);
    $furniture_subtype_id = $stmt->fetchColumn();
}}


// Вставка продукта
$stmt = $pdo->prepare(
    "INSERT INTO public.product 
        (name, sku, price, description, warranty, height, width, length, shelf_count, 
        drawer_count, material_id, color_id, furniture_type_id, furniture_subtype_id, storage_count) VALUES 
        (:product_name, :sku, :price, :description, :warranty, :height, :width, :length, :shelf_count, 
        :drawer_count, :material_id, :color_id, :furniture_type_id, :furniture_subtype_id, storage_count)"
    );

$stmt->execute([
    ':product_name' => $product_name,
    ':sku' => $sku,
    ':price' => $price,
    ':description' => $description,
    ':warranty' => $warranty,
    ':height' => $height,
    ':width' => $width,
    ':length' => $length,
    ':shelf_count' => $shelf_count,
    ':drawer_count' => $drawer_count,
    ':material_id' => $material_id,
    ':color_id' => $color_id,
    ':furniture_type_id' => $furniture_type_id,
    ':furniture_subtype_id' => $furniture_subtype_id,
    ':storage_count' => $storage_count
]);
$product_id = $pdo->lastInsertId();




// фото 3 
if ($product_id && isset($_FILES)) {
if (!is_dir($uploadDir)) {
    //mkdir($uploadDir, 0777, true);
}

for ($i = 1; $i <= 5; $i++) {
    $fileKey = "image_" . $i;
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
        $originalName = basename($_FILES[$fileKey]['name']);
        $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);
        $hash = hash('sha256', $originalName . microtime(true));
        $newFileName = substr($hash, 0, 20) . '.' . $fileExt;
        $targetPath = $uploadDir . $newFileName;
        
        if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $targetPath)) {

                // Сохраняем путь и product_id в базу данных
                $stmt = $pdo->prepare("INSERT INTO image (product_id, name) VALUES (:product_id, :image_name)");
                $stmt->execute([
                    ':product_id' => $product_id,
                    ':image_name' => $newFileName
                ]);  

        } 
    }
} 
}

           
} catch (PDOException $e) {
    http_response_code(500);    json_encode([ 'success' => true,'message' => 'Ошибка подключения к базе данных:'. echo $e->getMessage(); ])
   
}
        echo json_encode([ 'success' => true,'message' => 'http://valley.ru/pages/card.php?id=' . $product_id]);  //?id=$product_id         
    } else {
        echo json_encode(['success' => false, 'message' => 'Не указан ID товара']);
    }

}

?>
