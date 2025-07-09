<?php
header("Content-Type: application/json");

$host = "localhost";
$user = "root";
$pass = "";
$db = "leather_shop";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "DB connection failed."]));
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['user_id']) || !isset($data['cart']) || !is_array($data['cart'])) {
    echo json_encode(["status" => "error", "message" => "Invalid input."]);
    exit;
}

$user_id = intval($data['user_id']);
$cartItems = $data['cart'];

// Optional: Clear old cart for this user
$conn->query("DELETE FROM cart_items WHERE user_id = $user_id");

foreach ($cartItems as $item) {
    $product = $conn->real_escape_string($item['product']);
    $price = floatval($item['price']);
    $qty = intval($item['quantity']);
    $total = floatval($item['total']);

    $sql = "INSERT INTO cart_items (user_id, product_name, price, quantity, total_price) 
            VALUES ($user_id, '$product', $price, $qty, $total)";
    $conn->query($sql);
}

$conn->close();
echo json_encode(["status" => "success", "message" => "Cart saved"]);
?>
