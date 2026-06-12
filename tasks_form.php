<head>
    <link rel="stylesheet" href="style.css">
</head>

<?php
include 'conn.php';
include 'bootstrapslink.php';

$selected_project = $_GET['project_id'] ?? '';
$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$task_id  = $_POST['task_id'] ?? '';
$proj_id  = $_POST['proj_id'] ?? '';
$assin_to = $_POST['assin_to'] ?? '';
$deadline = $_POST['deadline'] ?? '';

if($task_id && $proj_id && $assin_to && $deadline){

$sql = "
UPDATE tasks
SET proj_id='$proj_id',
    assin_to='$assin_to',
    deadline='$deadline',
    status='Assigned'
WHERE task_id='$task_id'
";

if($conn->query($sql)){

header("Location: task.php?project_id=$proj_id");
exit;

}else{
$msg = "❌ Error: ".$conn->error;
}

}else{
$msg = "❌ All fields are required";
}

}

/* UNASSIGNED TASKS FETCH */
$tasks = $conn->query("
SELECT * FROM tasks
WHERE assin_to IS NULL OR assin_to = ''
");

/* USERS FETCH */
$users = $conn->query("SELECT * FROM users");

/* PROJECTS FETCH */
$projects = $conn->query("SELECT * FROM projects");
?>

<?php if($msg){ ?>
<p><?php echo $msg; ?></p>
<?php } ?>

<div class="tasks_form_container">

<div class="tasks_form_main">

<h1>Assign task</h1>
<br>

<div class="tasks_form">

<form method="POST">

<div class="form-group row"><br>

<label class="col-sm-4 col-form-label">
    Select Task
</label>

<div class="col-sm-10">

<select name="task_id"
        class="form-control"
        required>

<option value="">Select Task</option>

<?php while($t = $tasks->fetch_assoc()) { ?>

<option value="<?php echo $t['task_id']; ?>">
<?php echo $t['task_name']; ?>
</option>

<?php } ?>

</select>

</div>

</div>

<br>

<div class="form-group row">

<label class="col-sm-4 col-form-label">
    Select Project
</label>

<div class="col-sm-10">

<select name="proj_id"
        class="form-control"
        required>

<option value="">Select Project</option>

<?php while ($p = $projects->fetch_assoc()) { ?>

<option value="<?php echo $p['proj_id']; ?>"
<?php if($selected_project == $p['proj_id']) echo "selected"; ?>>

<?php echo $p['proj_name']; ?>

</option>

<?php } ?>

</select>

</div>

</div>

<br>

<div class="form-group row"><br>

<label class="col-sm-4 col-form-label">
    Assign To
</label>

<div class="col-sm-10">

<select name="assin_to"
        class="form-control"
        required>

<option value="">Select User</option>

<?php while ($row = $users->fetch_assoc()) { ?>

<option value="<?php echo $row['user_id']; ?>">
<?php echo $row['user_name']; ?>
</option>

<?php } ?>

</select>

</div>

</div>

<br>

<div class="form-group row"><br>

<label class="col-sm-4 col-form-label">
    Deadline
</label>

<div class="col-sm-10">

<input type="date"
       name="deadline"
       class="form-control"
       required>

</div>

</div>

<br>

<button type="submit"
        class="btn btn-success">

Assign Task

</button>

</form>

</div>

</div>

</div>