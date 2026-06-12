<?php

$conn = new mysqli("localhost","root","","jiraclone");

if(isset($_GET['id'])){

$id = $_GET['id'];

$conn->query("DELETE FROM projects WHERE proj_id=$id");

}


header("Location: ./project_form.php")
?>