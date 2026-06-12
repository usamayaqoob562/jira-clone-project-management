<?php

include 'conn.php';

$id = $_GET['id'];


$conn->query("
UPDATE tasks
SET assin_to = NULL
WHERE assin_to = '$id'
");


$conn->query("
DELETE FROM users
WHERE user_id = '$id'
");

header("Location: users.php");

exit();

?>