<?php
include 'conn.php';

$id = $_GET['id'];
$status = $_GET['status'];

$conn->query("
UPDATE tasks
SET status='$status'
WHERE task_id='$id'
");

header("Location: board.php");
exit;
?>