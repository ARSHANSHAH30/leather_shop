<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "leather_shop";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$rating = $_POST['rating'] ?? '';
$message = $_POST['message'] ?? '';

$sql = "INSERT INTO feedback (name, email, rating, message)
        VALUES ('$name', '$email', '$rating', '$message')";

if ($conn->query($sql) === TRUE) {
  echo "success";
} else {
  echo "Error: " . $conn->error;
}

$conn->close();
?>
