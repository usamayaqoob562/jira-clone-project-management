<<<<<<< HEAD
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

=======
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

>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
?>