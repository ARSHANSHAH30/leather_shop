<?php
header("Access-Control-Allow-Origin: *"); 
$host = "localhost";
$user = "root";
$pass = "";
$db = "leather_shop";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$city = $_POST['city'];
$zipcode = $_POST['zipcode'];
$country = $_POST['country'];
$shipping = $_POST['shipping'];
$sql = "INSERT INTO delivery_details (fullname, email, phone, address, city, zipcode, country, shipping_method)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $fullname, $email, $phone, $address, $city, $zipcode, $country, $shipping);

if ($stmt->execute()) {
  echo "success";
} else {
  echo "Error: " . $stmt->error;
}

$conn->close();
?>