<head>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
include 'conn.php';
include 'sidebar.php';

$id = $_GET['id'];

$task = $conn->query("
SELECT tasks.*, users.user_name AS previous_user
FROM tasks
JOIN users ON tasks.assin_to = users.user_id
WHERE tasks.task_id = '$id'
");

$data = $task->fetch_assoc();

$users = $conn->query("SELECT * FROM users");

if(isset($_POST['reassign'])){

    $old_user = $data['assin_to'];
    $new_user = $_POST['new_user'];

    $conn->query("
    INSERT INTO task_history (task_id, old_user_id, new_user_id)
    VALUES ('$id', '$old_user', '$new_user')
    ");

    $conn->query("
    UPDATE tasks
    SET assin_to = '$new_user'
    WHERE task_id = '$id'
    ");

    header("Location: task.php?project_id=".$data['proj_id']);
    exit;
}
?>

<div class="tasks_form_container">

<div class="tasks_form_main">

<h1>Re-Assign Task</h1>
<br>

<div class="tasks_form">

<form method="POST">

<div class="form-group row">
<label class="col-sm-4 col-form-label">Task Name</label>
<div class="col-sm-10">
<input type="text"
       class="form-control"
value="<?php echo isset($data['task_name']) ? $data['task_name'] : ''; ?>"       readonly>
</div>
</div>

<br>

<div class="form-group row">
<label class="col-sm-4 col-form-label">Previous User</label>
<div class="col-sm-10">
<input type="text"
       class="form-control"
value="<?php echo isset($data['previous_user']) ? $data['previous_user'] : ''; ?>"       readonly>
</div>
</div>

<br>

<div class="form-group row">
<label class="col-sm-4 col-form-label">New User</label>
<div class="col-sm-10">

<select name="new_user" class="form-control" required>
<option value="">Select New User</option>

<?php while($u = $users->fetch_assoc()) { ?>
<option value="<?php echo $u['user_id']; ?>">
<?php echo $u['user_name']; ?>
</option>
<?php } ?>

</select>

</div>
</div>

<br>

<button type="submit"
        name="reassign"
        class="btn btn-success">
Update
</button>

</form>

</div>

</div>

</div>