<<<<<<< HEAD
<?php

$conn = new mysqli("localhost","root","","jiraclone");

if(isset($_GET['id'])){

$id = $_GET['id'];

$conn->query("DELETE FROM projects WHERE proj_id=$id");

}


header("Location: ./project_form.php")
=======
<?php

$conn = new mysqli("localhost","root","","jiraclone");

if(isset($_GET['id'])){

$id = $_GET['id'];

$conn->query("DELETE FROM projects WHERE proj_id=$id");

}


header("Location: ./project_form.php")
>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
?>