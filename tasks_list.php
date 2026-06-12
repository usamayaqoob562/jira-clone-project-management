

<head>
    <title>Tasks List</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
 .tasks_list_main{
    margin-left:230px;
    padding:20px;
    width:auto;
}

        .tasks_header{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.tasks_header form{
    width:50%;
}

        .pagination_box{
            margin-top:20px;
            text-align:center;
        }

        .pagination_box a{
            margin:3px;
        }
    </style>
</head>
<?php
include 'conn.php';
include 'sidebar.php';
?>
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



/* DELETE TASK */
if(isset($_GET['delete_id'])){
    $delete_id = $_GET['delete_id'];

    $conn->query("DELETE FROM tasks WHERE task_id='$delete_id'");

    header("Location: tasks_list.php");
    exit();
}

$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$selected_project = $_GET['project_id'] ?? '';

$projects = $conn->query("SELECT * FROM projects");

/* TOTAL RECORDS */
if($selected_project != ''){
    $total_query = $conn->query("
        SELECT COUNT(*) AS total 
        FROM tasks 
        WHERE proj_id = '$selected_project'
    ");
}else{
    $total_query = $conn->query("
        SELECT COUNT(*) AS total 
        FROM tasks
    ");
}

$total_row = $total_query->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

/* TASKS FETCH */
$sql = "
SELECT 
    tasks.task_id,
    tasks.task_name,
    tasks.deadline,
    tasks.status,
    projects.proj_name,
    users.user_name
FROM tasks
JOIN projects 
ON tasks.proj_id = projects.proj_id
LEFT JOIN users 
ON tasks.assin_to = users.user_id
";

if($selected_project != ''){
    $sql .= " WHERE tasks.proj_id = '$selected_project'";
}

$sql .= "
ORDER BY tasks.task_id DESC
LIMIT $start, $limit
";

$result = $conn->query($sql);
?>

<div class="tasks_list_main">

    <div class="tasks_header">
        


    <form method="GET" class="d-flex gap-2">

        <select name="project_id"
                class="form-control"
                onchange="this.form.submit()">

            <option value="">All Projects</option>

            <?php while($p = $projects->fetch_assoc()) { ?>

                <option value="<?php echo $p['proj_id']; ?>"
                    <?php if($selected_project == $p['proj_id']) echo "selected"; ?>>

                    <?php echo $p['proj_name']; ?>

                </option>

            <?php } ?>

        </select>

    </form>

    <button
class="btn btn-success"
data-bs-toggle="modal"
data-bs-target="#addTaskModal">

Add Task

</button>

</div>

    <table class="table table-bordered table-striped ">

        <tr class= "text-center">
            <th>Project Name</th>
            <th>Task Name</th>
            <th>Assigned User</th>
            <th>Deadline Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php if($result->num_rows > 0) { ?>

            <?php while($row = $result->fetch_assoc()) { ?>

                <tr>
                    <td  class= "text-center"><?php echo $row['proj_name']; ?></td>
                    <td class= "text-center"><?php echo $row['task_name']; ?></td>
                    <td class= "text-center"><?php echo $row['user_name'] ?? 'Not Assigned'; ?></td>
                    <td class= "text-center"><?php echo $row['deadline']; ?></td>
                    <td class= "text-center"><?php echo $row['status']; ?></td>

                    <td class= "text-center">
                        <a href="edit_task.php?id=<?php echo $row['task_id']; ?>"
                           class="btn btn-sm btn-success">
                            Edit
                        </a>

                        <a href="tasks_list.php?delete_id=<?php echo $row['task_id']; ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure you want to delete this task?')">
                            Delete
                        </a>
                    </td>
                </tr>

            <?php } ?>

        <?php } else { ?>

            <tr>
                <td colspan="6" class="text-center">
                    No tasks found
                </td>
            </tr>

        <?php } ?>

    </table>
    <div class="modal fade" id="addTaskModal">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST" action="add_task_action.php">

<div class="modal-header">

<h5 class="modal-title">Add Task</h5>

<button type="button"
class="btn-close"
data-bs-dismiss="modal"></button>

</div>

<div class="modal-body">

<label>Task Name</label>

<input type="text"
name="task_name"
class="form-control"
required>

<br>


<label>Project Name</label>

<select name="proj_id"
class="form-control"
required>

<option value="">Select Project</option>

<?php

$projects_modal = $conn->query("SELECT * FROM projects");

while($p = $projects_modal->fetch_assoc()) {

?>

<option value="<?php echo $p['proj_id']; ?>">

<?php echo $p['proj_name']; ?>

</option>

<?php } ?>

</select>

<br>

<label>Status</label>

<select name="status"
class="form-control">

<option value="Pending">Pending</option>
<option value="In Progress">In Progress</option>
<option value="Done">Done</option>

</select>

<br>

<label>Deadline</label>

<input type="date"
name="deadline"
class="form-control"
required>

</div>

<div class="modal-footer">

<button type="submit"
name="add_task"
class="btn btn-success">

Add Task

</button>

</div>

</form>

</div>

</div>

</div>

    <div class="pagination_box">

        <?php for($i = 1; $i <= $total_pages; $i++) { ?>

            <a href="tasks_list.php?page=<?php echo $i; ?>&project_id=<?php echo $selected_project; ?>"
               class="btn btn-sm <?php echo ($page == $i) ? 'btn-secondary' : 'btn-secondary'; ?>">
                <?php echo $i; ?>
            </a>

        <?php } ?>

    </div>

</div>