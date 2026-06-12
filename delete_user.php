<<<<<<< HEAD
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

=======
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

>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
?>