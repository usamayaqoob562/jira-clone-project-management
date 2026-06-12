<?php

include 'conn.php';

$id   = $_POST['proj_id'];

$name = $_POST['proj_name'];

$desc = $_POST['proj_disc'];

$conn->query("
UPDATE projects
SET proj_name='$name',
proj_disc='$desc'
WHERE proj_id='$id'
");

header("Location: project_form.php");

?>