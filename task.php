<head>
    <title>Jira Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

/* Browser Cache Disable */

header("Cache-Control: no-cache, no-store, must-revalidate");

header("Pragma: no-cache");

header("Expires: 0");

?>

<?php 
include 'conn.php'; 
include 'sidebar.php';
include 'bootstrapslink.php';

$projects = $conn->query("SELECT * FROM projects");

$all_users = $conn->query("SELECT * FROM users");
$assign_users = $conn->query("SELECT * FROM users");

$selected_project = $_GET['project_id'] ?? '';
?>

<div class="project_task_main">

<div class="project_tasks_subbox">

<div class="project_tasks_heading">
</div>

</div>

<div class="task_table_main">

<div class="container mt-2">

<form method="GET" class="mb-4">

<label class="form-label">Search / Select Project</label>

<select name="project_id"
        class="form-control"
        onchange="this.form.submit()">

<option value="">Select Project</option>

<?php while($p = $projects->fetch_assoc()) { ?>

<option value="<?php echo $p['proj_id']; ?>"
<?php if($selected_project == $p['proj_id']) echo "selected"; ?>>

<?php echo $p['proj_name']; ?>

</option>

<?php } ?>

</select>

</form>

<?php if($selected_project != '') { ?>

<?php
$sql = "
SELECT 
    tasks.task_id,
    tasks.task_name,
    tasks.deadline,
    tasks.status,
    tasks.assin_to,
    users.user_name
FROM tasks
LEFT JOIN users 
ON tasks.assin_to = users.user_id
WHERE tasks.proj_id = '$selected_project'
ORDER BY tasks.task_id DESC
";

$result = $conn->query($sql);

echo "<table border='1' cellpadding='10' cellspacing='0' style='width:100%'>";

echo "<tr>
<th>Task Name</th>
<th>Assigned User</th>
<th>Deadline</th>
<th>Status</th>
<th>Actions</th>
</tr>";

if($result->num_rows > 0){

while ($row = $result->fetch_assoc()) {

$user_name = $row['user_name'] ?? 'Not Assigned';

echo "<tr>";

echo "<td>{$row['task_name']}</td>";
echo "<td>{$user_name}</td>";
echo "<td>{$row['deadline']}</td>";
echo "<td>{$row['status']}</td>";

echo "<td>";

if($row['assin_to'] == NULL || $row['assin_to'] == ''){

echo "
<button
class='btn btn-success btn-sm'
data-bs-toggle='modal'
data-bs-target='#assignTaskModal'
data-id='{$row['task_id']}'
data-task='{$row['task_name']}'
data-project='$selected_project'>

Assign Task

</button>
";

}else{

echo "
<button
class='btn btn-warning btn-sm'
data-bs-toggle='modal'
data-bs-target='#reassignTaskModal'
data-id='{$row['task_id']}'
data-task='{$row['task_name']}'
data-user='{$user_name}'>

Re-Assign

</button>
";

}

echo "
<a href='task_details.php?id={$row['task_id']}'
class='btn btn-info btn-sm ms-1'>
Details
</a>
";

echo "</td>";

echo "</tr>";

}

}else{

echo "
<tr>
<td colspan='5' class='text-center'>
No tasks found for this project
</td>
</tr>
";

}

echo "</table>";
?>

<?php } ?>

</div>

</div>

</div>


<!-- Assign Task Modal -->

<div class="modal fade" id="assignTaskModal">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST" action="assign_task_action.php">

<div class="modal-header">

<h5 class="modal-title">Assign Task</h5>

<button type="button"
class="btn-close"
data-bs-dismiss="modal"></button>

</div>

<div class="modal-body">

<input type="hidden"
name="task_id"
id="assign_task_id">

<input type="hidden"
name="project_id"
id="assign_project_id">

<label>Task Name</label>

<input type="text"
id="assign_task_name"
class="form-control"
readonly>

<br>

<label>Select User</label>

<select name="assign_user"
class="form-control"
required>

<option value="">Select User</option>

<?php while($u = $assign_users->fetch_assoc()) { ?>

<option value="<?php echo $u['user_id']; ?>">
<?php echo $u['user_name']; ?>
</option>

<?php } ?>

</select>

</div>

<div class="modal-footer">

<button type="submit"
name="assign_task"
class="btn btn-success">

Assign

</button>

</div>

</form>

</div>

</div>

</div>


<!-- Re-Assign Modal -->

<div class="modal fade" id="reassignTaskModal">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST" action="reassign_task_action.php">

<div class="modal-header">

<h5 class="modal-title">Re-Assign Task</h5>

<button type="button"
class="btn-close"
data-bs-dismiss="modal"></button>

</div>

<div class="modal-body">

<input type="hidden"
name="task_id"
id="reassign_task_id">

<input type="hidden"
name="project_id"
value="<?php echo $selected_project; ?>">

<label>Task Name</label>

<input type="text"
id="reassign_task_name"
class="form-control"
readonly>

<br>

<label>Previous User</label>

<input type="text"
id="reassign_previous_user"
class="form-control"
readonly>

<br>

<label>New User</label>

<select name="new_user"
class="form-control"
required>

<option value="">Select New User</option>

<?php while($u = $all_users->fetch_assoc()) { ?>

<option value="<?php echo $u['user_id']; ?>">
<?php echo $u['user_name']; ?>
</option>

<?php } ?>

</select>

</div>

<div class="modal-footer">

<button type="submit"
name="reassign"
class="btn btn-success">

Update

</button>

</div>

</form>

</div>

</div>

</div>


<script>

var assignModal = document.getElementById('assignTaskModal');

assignModal.addEventListener('show.bs.modal', function(event){

var button = event.relatedTarget;

document.getElementById('assign_task_id').value =
button.getAttribute('data-id');

document.getElementById('assign_task_name').value =
button.getAttribute('data-task');

document.getElementById('assign_project_id').value =
button.getAttribute('data-project');

});


var reassignModal = document.getElementById('reassignTaskModal');

reassignModal.addEventListener('show.bs.modal', function(event){

var button = event.relatedTarget;

document.getElementById('reassign_task_id').value =
button.getAttribute('data-id');

document.getElementById('reassign_task_name').value =
button.getAttribute('data-task');

document.getElementById('reassign_previous_user').value =
button.getAttribute('data-user');

});

</script>