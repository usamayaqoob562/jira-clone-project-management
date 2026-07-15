<<<<<<< HEAD
<?php
include 'conn.php';


$id = $_GET['id'];
$status = $_GET['status'];

$sql = "UPDATE tasks SET status='$status' WHERE id=$id";

$conn->query($sql);

header("Location: board.php");
exit;

=======
<?php
include 'conn.php';


$id = $_GET['id'];
$status = $_GET['status'];

$sql = "UPDATE tasks SET status='$status' WHERE id=$id";

$conn->query($sql);

header("Location: board.php");
exit;

>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
?>