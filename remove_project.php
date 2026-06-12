<?php

include 'conn.php';

$assign_id = $_GET['assign_id'];
$project_id = $_GET['project_id'];

$conn->query("
DELETE FROM project_assign_users
WHERE id = '$assign_id'
");

header("Location: project_detail.php?id=$project_id");
exit;

?>