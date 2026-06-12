<<<<<<< HEAD
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

=======
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

>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
?>