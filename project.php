<head>
    <title>Jira Clone</title>

    <link rel="stylesheet" href="style.css">
</head>;


<?php
session_start();
include 'conn.php';

if(isset($_POST['proj_name'])){

$proj_name = $_POST['proj_name'];
$is_going = $_POST['is_going'];
$start = $_POST['proj_start_date'];
$deadline = $_POST['proj_deadline'];

$user_id = $_SESSION['user_id'];

}



if(isset($_POST['proj_name'])){

$proj_name = $_POST['proj_name'];
$is_going = $_POST['is_going'];
$start = $_POST['proj_start_date'];
$deadline = $_POST['proj_deadline'];

$user_id = $_SESSION['user_id'];

$sql = "INSERT INTO project
(proj_name, is_going, proj_start_date, proj_deadline, proj_comp_by)
VALUES
('$proj_name','$is_going','$start','$deadline','$user_id')";

if($conn->query($sql)){
echo "Project Created Successfully";
}
else{
echo $conn->error;
}

}

?>
<a href="dashboard.php">⬅ Back to Dashboard</a>
<hr>

<div style="margin-left:240px; padding:20px;">
    
</div>