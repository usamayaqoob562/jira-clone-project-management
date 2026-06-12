<head>
    <title>Jira Clone</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<?php
include 'sidebar.php';
include 'conn.php';

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$start_date = $_GET['start_date'] ?? '';
$end_date   = $_GET['end_date'] ?? '';

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$limit = 10;

$start = ($page - 1) * $limit;

/* DATE FILTER */

$date_condition = "";

if($start_date != '' && $end_date != '')
{
    $date_condition =
    " AND tasks.deadline BETWEEN '$start_date' AND '$end_date'";
}

/* TOTAL RECORDS */

$total_query = $conn->query("
SELECT COUNT(*) as total
FROM tasks
WHERE tasks.assin_to IS NOT NULL
AND tasks.assin_to != ''
AND tasks.task_name IS NOT NULL
AND tasks.task_name != ''
$date_condition
");

$total_row = $total_query->fetch_assoc();

$total_records = $total_row['total'];

$total_pages = ceil($total_records / $limit);

/* TASKS QUERY */

$tasks = $conn->query("
SELECT
    tasks.task_name,
    tasks.status,
    users.user_name
FROM tasks
LEFT JOIN users
ON tasks.assin_to = users.user_id
WHERE tasks.assin_to IS NOT NULL
AND tasks.assin_to != ''
AND tasks.task_name IS NOT NULL
AND tasks.task_name != ''
$date_condition
LIMIT $start, $limit
");
?>

<div class="report_main">

<h1>Tasks Report</h1>

<form method="GET"
class="d-flex gap-2 mb-4 w-50">

<input type="date"
       name="start_date"
       class="form-control"
       value="<?php echo $start_date; ?>">

<input type="date"
       name="end_date"
       class="form-control"
       value="<?php echo $end_date; ?>">

<button type="submit"
        class="btn btn-success">

Search

</button>

</form>

<table class="table table-bordered table-striped">

<tr class="text-center">

<th>Task Name</th>

<th>Assigned User</th>

<th>Status</th>

</tr>

<?php if($tasks->num_rows > 0){ ?>

<?php while($row = $tasks->fetch_assoc()){ ?>

<tr class="text-center">

<td>
<?php echo $row['task_name']; ?>
</td>

<td>
<?php echo $row['user_name'] ?? 'Not Assigned'; ?>
</td>

<td>
<?php echo $row['status']; ?>
</td>

</tr>

<?php } ?>

<?php } else { ?>

<tr>

<td colspan="3" class="text-center">

No tasks found

</td>

</tr>

<?php } ?>

</table>
<?php
$pending_count = $conn->query("
SELECT COUNT(*) AS total 
FROM tasks 
WHERE status='Pending'
$date_condition
")->fetch_assoc()['total'];

$progress_count = $conn->query("
SELECT COUNT(*) AS total 
FROM tasks 
WHERE status='InProgress'
$date_condition
")->fetch_assoc()['total'];

$done_count = $conn->query("
SELECT COUNT(*) AS total 
FROM tasks 
WHERE status='Done'
$date_condition
")->fetch_assoc()['total'];
?>

<div class="row mt-4 text-center">

    <div class="col-md-4">
        <div class="card p-2 shadow">
            <h5>Pending Tasks</h5>
            <h2><?php echo $pending_count; ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-2 shadow">
            <h5>In Progress Tasks</h5>
            <h2><?php echo $progress_count; ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-2 shadow">
            <h5>Done Tasks</h5>
            <h2><?php echo $done_count; ?></h2>
        </div>
    </div>

</div>

<!-- Pagination -->

<div class="text-center mt-3">

<?php for($i = 1; $i <= $total_pages; $i++) { ?>

<a href="report.php?page=<?php echo $i; ?>&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>"
class="btn btn-secondary btn-sm mx-1">

<?php echo $i; ?>

</a>

<?php } ?>

</div>

</div>