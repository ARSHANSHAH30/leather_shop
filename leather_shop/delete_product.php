<?php
// delete_product.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "leather_shop";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product ID from URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Delete the product from DB
    $sql = "DELETE FROM admin_product WHERE id = $product_id";

    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully.";
    header("Location: http://localhost/LUXE%20LEATHER%20UI/leather_shop/myproducts.php");

        // Optional: Redirect back to the main page
        // header("Location: website.php");
    } else {
        echo "Error deleting product: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
