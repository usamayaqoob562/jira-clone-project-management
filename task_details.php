<<<<<<< HEAD
<head>
    <title>Task Details</title>

    <link rel="stylesheet" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
include 'conn.php';
include 'sidebar.php';

$id = $_GET['id'];

/* TASK INFO */

$task = $conn->query("
SELECT 
    tasks.task_name,
    tasks.deadline,
    tasks.status,
    users.user_name

FROM tasks

LEFT JOIN users
ON tasks.assin_to = users.user_id

WHERE tasks.task_id = '$id'
");

$t = $task->fetch_assoc();

/* HISTORY */

$history = $conn->query("
SELECT 
    task_history.*,

    old_user.user_name AS old_user_name,

    new_user.user_name AS new_user_name

FROM task_history

JOIN users AS old_user
ON task_history.old_user_id = old_user.user_id

JOIN users AS new_user
ON task_history.new_user_id = new_user.user_id

WHERE task_history.task_id = '$id'

ORDER BY task_history.history_id DESC
");
?>

<div class="container mt-5" style="margin-left: 250px; width:80%;">

<div class="card p-4 shadow">

<h2 class="mb-4">Task Details</h2>

<table class="table table-bordered ">

<tr>
<th width="30%">Task Name</th>
<td><?php echo $t['task_name']; ?></td>
</tr>

<tr>
<th>Current User</th>
<td><?php echo $t['user_name']; ?></td>
</tr>

<tr>
<th>Deadline</th>
<td><?php echo $t['deadline']; ?></td>
</tr>

<tr>
<th>Status</th>
<td><?php echo $t['status']; ?></td>
</tr>

</table>

<br>

<h3>Task History</h3>

<table class="table table-striped table-bordered">

<tr>
<th>Previous User</th>
<th>New User</th>
<th>Changed At</th>
</tr>

<?php if($history->num_rows > 0){ ?>

<?php while($h = $history->fetch_assoc()) { ?>

<tr>

<td>
<?php echo $h['old_user_name']; ?>
</td>

<td>
<?php echo $h['new_user_name']; ?>
</td>

<td>
<?php echo $h['changed_at']; ?>
</td>

</tr>

<?php } ?>

<?php } else { ?>

<tr>
<td colspan="3" class="text-center">
No History Found
</td>
</tr>

<?php } ?>

</table>

<a href="task.php?project_id=<?php echo $t['proj_id'] ?? ''; ?>"
class="btn btn-secondary">

Back

</a>

</div>

=======
<head>
    <title>Task Details</title>

    <link rel="stylesheet" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
include 'conn.php';
include 'sidebar.php';

$id = $_GET['id'];

/* TASK INFO */

$task = $conn->query("
SELECT 
    tasks.task_name,
    tasks.deadline,
    tasks.status,
    users.user_name

FROM tasks

LEFT JOIN users
ON tasks.assin_to = users.user_id

WHERE tasks.task_id = '$id'
");

$t = $task->fetch_assoc();

/* HISTORY */

$history = $conn->query("
SELECT 
    task_history.*,

    old_user.user_name AS old_user_name,

    new_user.user_name AS new_user_name

FROM task_history

JOIN users AS old_user
ON task_history.old_user_id = old_user.user_id

JOIN users AS new_user
ON task_history.new_user_id = new_user.user_id

WHERE task_history.task_id = '$id'

ORDER BY task_history.history_id DESC
");
?>

<div class="container mt-5" style="margin-left: 250px; width:80%;">

<div class="card p-4 shadow">

<h2 class="mb-4">Task Details</h2>

<table class="table table-bordered ">

<tr>
<th width="30%">Task Name</th>
<td><?php echo $t['task_name']; ?></td>
</tr>

<tr>
<th>Current User</th>
<td><?php echo $t['user_name']; ?></td>
</tr>

<tr>
<th>Deadline</th>
<td><?php echo $t['deadline']; ?></td>
</tr>

<tr>
<th>Status</th>
<td><?php echo $t['status']; ?></td>
</tr>

</table>

<br>

<h3>Task History</h3>

<table class="table table-striped table-bordered">

<tr>
<th>Previous User</th>
<th>New User</th>
<th>Changed At</th>
</tr>

<?php if($history->num_rows > 0){ ?>

<?php while($h = $history->fetch_assoc()) { ?>

<tr>

<td>
<?php echo $h['old_user_name']; ?>
</td>

<td>
<?php echo $h['new_user_name']; ?>
</td>

<td>
<?php echo $h['changed_at']; ?>
</td>

</tr>

<?php } ?>

<?php } else { ?>

<tr>
<td colspan="3" class="text-center">
No History Found
</td>
</tr>

<?php } ?>

</table>

<a href="task.php?project_id=<?php echo $t['proj_id'] ?? ''; ?>"
class="btn btn-secondary">

Back

</a>

</div>

>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
</div>