<<<<<<< HEAD
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

=======
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

>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
?>