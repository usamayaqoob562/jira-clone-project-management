<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

include 'conn.php';
include 'sidebar.php';

$user_id = $_SESSION['user_id'];
$selected_date = $_GET['task_date'] ?? '';
?>

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<style>
body{
    font-family: Arial;
    background:#f4f6f8;
}

.main_board{
    margin-left:220px;
    padding:20px;
}

.board{
    display:flex;
    gap:20px;
    padding:20px;
}

.column{
    flex:1;
    background:white;
    border-radius:10px;
    padding:15px;
    box-shadow:0 2px 6px rgba(0,0,0,0.1);
    min-height:400px;
}

.column h3{
    text-align:center;
    padding-bottom:10px;
    border-bottom:1px solid #ddd;
}

.card{
    color:black;
    padding:12px;
    margin:10px 0;
    border-radius:6px;
    cursor:grab;
    border:none;
    font-weight:500;
}

/* Pending */
.pending-card{
    background:#ffe5b4;
}

/* In Progress */
.progress-card{
    background:#bde0fe;
}

/* Done */
.done-card{
    background:#b7efc5;
}
.task-search{
    width: 100%;
    border-radius:8px;
    padding:10px;
    border:1px solid black;
    box-shadow:none;
}

.task-search:focus{
    border-color:#198754;
    box-shadow:0 0 5px rgba(25,135,84,0.4);
}
</style>

<div class="main_board">

<h2 align="center">Task Board</h2>
<div class="d-flex justify-content-center mb-4">

<form method="GET" class="d-flex gap-2 w-50">

<input type="date"
       name="task_date"
       class="form-control"
       value="<?php echo $selected_date; ?>">

<button type="submit"
        class="btn btn-success">

Search

</button>

</form>

</div>
<div class="board">

<!-- PENDING -->
<div class="column " ondrop="drop(event, 'Pending')" ondragover="allowDrop(event)">
<h3>Pending</h3>
<input type="text"
       class="form-control mb-2 task-search"
       placeholder="Search Pending Task..."
       onkeyup="searchTasks(this)">

<?php
$res = $conn->query("
SELECT * FROM tasks 
WHERE status='Pending'
AND assin_to='$user_id'
" . ($selected_date != '' ? " AND deadline='$selected_date'" : "") . "
");

while($row = $res->fetch_assoc()){
?>

<div class="card task-card pending-card"
     draggable="true"
     ondragstart="drag(event)"
     data-id="<?php echo $row['task_id']; ?>">
    <?php echo $row['task_name']; ?>
</div>

<?php } ?>

</div>

<!-- IN PROGRESS -->
<div class="column" ondrop="drop(event, 'InProgress')" ondragover="allowDrop(event)">
<h3>In Progress</h3>
<input type="text"
       class="form-control mb-2 task-search"
       placeholder="Search  in progress  Task..."
       onkeyup="searchTasks(this)">

<?php
$res = $conn->query("
SELECT * FROM tasks 
WHERE status='InProgress'
AND assin_to='$user_id'
" . ($selected_date != '' ? " AND deadline='$selected_date'" : "") . "
");

while($row = $res->fetch_assoc()){
?>

<div class="card task-card progress-card"
     draggable="true"
     ondragstart="drag(event)"
     data-id="<?php echo $row['task_id']; ?>">
    <?php echo $row['task_name']; ?>
</div>

<?php } ?>

</div>

<!-- DONE -->
<div class="column" ondrop="drop(event, 'Done')" ondragover="allowDrop(event)">
<h3>Done</h3>
<input type="text"
       class="form-control mb-2 task-search"
       placeholder="Search Done Task..."
       onkeyup="searchTasks(this)">

<?php
$res = $conn->query("
SELECT * FROM tasks 
WHERE status='Done'
AND assin_to='$user_id'
" . ($selected_date != '' ? " AND deadline='$selected_date'" : "") . "
");
while($row = $res->fetch_assoc()){
?>

<div class="card task-card done-card"
     draggable="true"
     ondragstart="drag(event)"
     data-id="<?php echo $row['task_id']; ?>">
    <?php echo $row['task_name']; ?>
</div>

<?php } ?>

</div>

</div>

</div>

<script>
let taskId = null;

function allowDrop(event){
    event.preventDefault();
}

function drag(event){
    taskId = event.target.getAttribute("data-id");
}

function drop(event, status){
    event.preventDefault();

    window.location.href = "update.php?id=" + taskId + "&status=" + status;
}

function searchTasks(input) {

    let searchValue = input.value.toLowerCase();

    let column = input.closest(".column");

    let cards = column.querySelectorAll(".task-card");

    cards.forEach(function(card) {

        let taskName = card.innerText.toLowerCase();

        if(taskName.includes(searchValue)) {
            card.style.display = "";
        } else {
            card.style.display = "none";
        }

    });
}

</script>