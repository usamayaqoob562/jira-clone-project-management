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

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>

<?php include 'sidebar.php'; ?>


<div class="main">
    <h2>Welcome, <?php echo $_SESSION['user_name']; ?></h2>


    <div class="navbar">
        <div class="navbuttons">
<ul>
    <li><a href="project_form.php">📁projects</a> 
</li>
    <li><a href="report.php">📊 Report</a> 
</li>
    <li><a href="board.php">🧱 Jira Board</a> 
</li>
</ul>
</div>

<div class="userprofile">

<a href="logout.php">🚪 Logout</a>


</div>
</div>


    <div class="cards">
        <div class="card">Total Tasks</div>
        <div class="card">Pending</div>
        <div class="card">Done</div>
    </div>

    

<?php

$totalTasks = $conn->query("SELECT COUNT(*) as total FROM tasks")->fetch_assoc()['total'];

$pending = $conn->query("SELECT COUNT(*) as total FROM tasks WHERE status='Pending'")->fetch_assoc()['total'];

$done = $conn->query("SELECT COUNT(*) as total FROM tasks WHERE status='Done'")->fetch_assoc()['total'];
?>

<div style="display:flex; gap:20px; margin:20px;">
    <div>Total Tasks: <?php echo $totalTasks; ?></div>
    <div>Pending: <?php echo $pending; ?></div>
    <div>Done: <?php echo $done; ?></div>
</div>






<?php
$projects = $conn->query("SELECT * FROM projects");
?>


<h2>Tasks</h2>
<div class =tasks >

<?php
$sql = "SELECT tasks.task_name, tasks.status, users.user_name
        FROM tasks
        JOIN users ON tasks.assin_to = users.user_id";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div>
        📌 {$row['task_name']} - {$row['user_name']} - {$row['status']}
    </div>";
}
?>
</div>




</div>







