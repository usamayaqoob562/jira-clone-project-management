<<<<<<< HEAD
<?php

include 'conn.php';

$task_name = $_POST['task_name'];
$proj_id   = $_POST['proj_id'];
$status    = $_POST['status'];
$deadline  = $_POST['deadline'];

$sql = "
INSERT INTO tasks
(task_name, proj_id, status, deadline)

VALUES
('$task_name', '$proj_id', '$status', '$deadline')
";

if($conn->query($sql)){
    header("Location: tasks_list.php");
    exit;
}else{
    echo "Error: " . $conn->error;
}

=======
<?php

include 'conn.php';

$task_name = $_POST['task_name'];
$proj_id   = $_POST['proj_id'];
$status    = $_POST['status'];
$deadline  = $_POST['deadline'];

$sql = "
INSERT INTO tasks
(task_name, proj_id, status, deadline)

VALUES
('$task_name', '$proj_id', '$status', '$deadline')
";

if($conn->query($sql)){
    header("Location: tasks_list.php");
    exit;
}else{
    echo "Error: " . $conn->error;
}

>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
?>