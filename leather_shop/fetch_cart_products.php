<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "leather_shop");

$productIds = json_decode(file_get_contents("php://input"), true);

if (!is_array($productIds) || empty($productIds)) {
    echo json_encode([]);
    exit;
}

$placeholders = implode(',', array_fill(0, count($productIds), '?'));
$types = str_repeat('i', count($productIds));

$stmt = $conn->prepare("SELECT id, product_name, product_price FROM admin_product WHERE id IN ($placeholders)");
$stmt->bind_param($types, ...$productIds);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
?>
