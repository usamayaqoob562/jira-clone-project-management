<?php
include 'conn.php';


$id = $_GET['id'];
$status = $_GET['status'];

$sql = "UPDATE tasks SET status='$status' WHERE id=$id";

$conn->query($sql);

header("Location: board.php");
exit;

?>