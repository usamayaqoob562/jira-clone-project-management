<?php
include 'conn.php';

$task_name = $_POST['task_name'];
$assin_to = $_POST['assin_to'];
$assin_date = $_POST['assin_date'];
$deadline = $_POST['deadline'];

$sql = "INSERT INTO tasks (task_name, assin_to, assin_date, deadline, status)
        VALUES ('$task_name', '$assin_to', '$assin_date', '$deadline', 'Pending')";

if ($conn->query($sql)) {
    echo "✅ Task Assigned Successfully";
    header("Location: task.php");
} else {
    echo "Error: " . $conn->error;
}
?>
<a href="dashboard.php">⬅ Back to Dashboard</a>
<hr>
<?php include 'sidebar.php'; ?>

<div style="margin-left:240px; padding:20px;">
    <h1>Dashboard</h1>
</div>