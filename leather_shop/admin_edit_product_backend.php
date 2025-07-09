<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "leather_shop";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Receive product data
$product_id = $_POST['id'];
$product_name = $_POST['name'];
$product_price = $_POST['price'];
$product_description = $_POST['description'];
$product_category = $_POST['category'];
$product_subcategory = $_POST['subcategory'];


$photoName = $_FILES['image']['name'];
$photoTmp = $_FILES['image']['tmp_name'];
$photoExt = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));
$allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];

$photoUpdated = false;
// Check if a new image is uploaded
if (!empty($photoName) && in_array($photoExt, $allowedExtensions)) {
    $uniqueName = rand(1000, 9999) . '_' . $photoName;
    $uploadPath = 'img/uploads/' . $uniqueName;

    if (move_uploaded_file($photoTmp, $uploadPath)) {
        $photoUpdated = true;
    } else {
        die("❌ Failed to upload the new image.");
    }
}
// SQL UPDATE Query
if ($photoUpdated) {
    $sql = "UPDATE admin_product SET 
                product_name = '$product_name',
                product_price = '$product_price',
                product_description = '$product_description',
                product_category = '$product_category',
                product_subcategory'$product_subcategory',
                product_file = '$uniqueName'
            WHERE id = '$product_id'";
} else {
    
    $sql = "UPDATE admin_product SET 
                product_name = '$product_name',
                product_price = '$product_price',
                product_description = '$product_description',
                product_category = '$product_category',
                product_subcategory'$product_subcategory',
            WHERE id = '$product_id'";
}
// Run query
if ($conn->query($sql) === TRUE) {
    echo "✅ Product updated successfully.";
    echo "<br><a href='admin_dashboard.php'>← Back to Dashboard</a>";
    header("Location: http://localhost/LUXE%20LEATHER%20UI/leather_shop/myproducts.php");
} else {
    // echo "❌ Error: " . $conn->error;
    echo "❌ SQL Error: " . $conn->error;
echo "<br>Query: " . $sql;
}
// close connection
$conn->close();
?>
