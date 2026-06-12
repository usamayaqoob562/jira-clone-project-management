<?php

include 'conn.php';

$id = $_POST['user_id'];

$name = $_POST['user_name'];

$email = $_POST['email'];

$conn->query("
UPDATE users
SET user_name='$name',
email='$email'
WHERE user_id='$id'
");

header("Location: users.php");

?>