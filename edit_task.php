<head>
    <title>Edit Task</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<?php
include 'conn.php';

if(!isset($_GET['id'])){
    die("Task ID missing");
}

$task_id = $_GET['id'];

$task = $conn->query("
SELECT * FROM tasks 
WHERE task_id='$task_id'
");

$row = $task->fetch_assoc();

if(isset($_POST['update_task'])){

    $task_name = $_POST['task_name'];
    $deadline = $_POST['deadline'];

    $conn->query("
    UPDATE tasks SET
    task_name='$task_name',
    deadline='$deadline'
    WHERE task_id='$task_id'
    ");

    header("Location: tasks_list.php");
    exit();
}
?>

<div class="container mt-5">

    <div class="card p-4 shadow" style="width:50%; margin:auto;">

        <h2>Edit Task</h2>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Task Name</label>
                <input type="text"
                       name="task_name"
                       class="form-control"
                       value="<?php echo $row['task_name']; ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deadline</label>
                <input type="date"
                       name="deadline"
                       class="form-control"
                       value="<?php echo $row['deadline']; ?>"
                       required>
            </div>

            <button type="submit"
                    name="update_task"
                    class="btn btn-success">
                Update Task
            </button>

            <a href="tasks_list.php" class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>