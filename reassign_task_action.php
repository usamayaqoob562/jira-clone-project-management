<?php

include 'conn.php';

$task_id = $_POST['task_id'];
$project_id = $_POST['project_id'];
$new_user = $_POST['new_user'];

$old = $conn->query("SELECT assin_to FROM tasks WHERE task_id='$task_id'");
$data = $old->fetch_assoc();

$old_user = $data['assin_to'];

$conn->query("
INSERT INTO task_history(task_id, old_user_id, new_user_id)
VALUES('$task_id', '$old_user', '$new_user')
");

$conn->query("
UPDATE tasks
SET assin_to='$new_user'
WHERE task_id='$task_id'
");

header("Location: task.php?project_id=$project_id");
exit;

?>