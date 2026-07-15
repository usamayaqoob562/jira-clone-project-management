<<<<<<< HEAD
<?php

include 'conn.php';

$task_id = $_POST['task_id'];
$project_id = $_POST['project_id'];
$assign_user = $_POST['assign_user'];

$conn->query("
UPDATE tasks
SET assin_to = '$assign_user',
    status = 'pending'
WHERE task_id = '$task_id'
");

header("Location: task.php?project_id=$project_id");
exit;

=======
<?php

include 'conn.php';

$task_id = $_POST['task_id'];
$project_id = $_POST['project_id'];
$assign_user = $_POST['assign_user'];

$conn->query("
UPDATE tasks
SET assin_to = '$assign_user',
    status = 'pending'
WHERE task_id = '$task_id'
");

header("Location: task.php?project_id=$project_id");
exit;

>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
?>