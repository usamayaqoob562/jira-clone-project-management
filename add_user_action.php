<?php

include 'conn.php';

$name = $_POST['user_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$rank = $_POST['user_rank'];

$hashed_password =
password_hash($password, PASSWORD_DEFAULT);

$conn->query("
INSERT INTO users
(user_name, email, password, user_rank)

VALUES
('$name', '$email', '$hashed_password', '$rank')
");

header("Location: users.php");
exit;

?>