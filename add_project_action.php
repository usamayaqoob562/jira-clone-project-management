<?php
include 'conn.php';

$name = $_POST['proj_name'];
$desc = $_POST['proj_disc'];
$start = $_POST['proj_start_date'];
$deadline = $_POST['proj_deadline'];

$conn->query("
INSERT INTO projects
(proj_name, proj_disc, proj_start_date, proj_deadline)
VALUES
('$name', '$desc', '$start', '$deadline')
");

header("Location: project_form.php");
exit;
?>