<?php
// Database connection
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "leather_shop";
// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Handle Sign Up
$product_name = $_POST['name'];
$product_price = $_POST['price'];
$product_description = $_POST['description'];
$product_category = $_POST['category'];
$product_subcategory = $_POST['sub-category'];


$photoName = $_FILES['image']['name'];
$photoSize = $_FILES['image']['name'];
$photoTmp = $_FILES['image']['tmp_name'];
$photoType = $_FILES['image']['type'];

$photoAllowedExtention = array('jpeg', 'jpg', 'png', 'gif');
$photoExtention = explode('.', $photoName);
$photoExtention = end($photoExtention);
$photoExtention = strtolower($photoExtention);

if (!in_array($photoExtention, $photoAllowedExtention) && !empty($photoName)) {
    $data['photo_err'] = 'Sorry, The Extention Not Allowed :(';
} elseif (empty($photoName)) {
    $data['photo_err'] = 'Please add a photo for the product';
}

if (empty($data['photo_err'])) {
    $randomNum = rand(0, 100000);
    move_uploaded_file($photoTmp, 'img/uploads/' . $randomNum . '_' . $photoName);
    $data['photo'] = $randomNum . '_' . $photoName;
    if ($data) {
        // redirect('pages');
        echo "Added Image";
    } else {
        die('something went wrong');
    }
} else {
    // $this->view('users/addPost', $data);
    die('Error went wrong');

}
// Insert user data into database
$sql = "INSERT INTO admin_product 
        (product_name, product_price, product_description, product_category,product_subcategory, product_file) 
        VALUES 
        ('$product_name', '$product_price', '$product_description', '$product_category','$product_subcategory', '{$data['photo']}')";

if ($conn->query($sql) === TRUE) {
    echo "Product Added successfully.";
    header("Location: http://localhost/LUXE%20LEATHER%20UI/leather_shop/myproducts.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// Close connection
$conn->close();
?>