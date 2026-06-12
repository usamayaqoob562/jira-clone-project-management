<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <title>Jira Clone</title>

    <link rel="stylesheet" href="style.css">
</head>


<?php

$conn = new mysqli("localhost","root","","jiraclone");

$id = $_GET['id'];

$sql = "SELECT * FROM projects WHERE proj_id=$id";
$result = $conn->query($sql);

$row = $result->fetch_assoc();

?>
<div class="edit_form_container">
<div class="edit_form_main">
<div class="edit_form">

<h1>Edit project</h1>

<div class="edit_form">

<form method="POST">

<div class="form-group row"><br>
<label class="col-sm-4 col-form-label">
Name
</label> 

<div class="col-sm-10">
<input
type="text"
name="proj_name"
value="<?php echo $row['proj_name']; ?>"
class="form-control"
required>
</div>
</div>


<br>
<div class="form-group row">

<label class="col-sm-4 col-form-label">
Description
</label>

<div class="col-sm-10">
<textarea name="proj_disc"
class="form-control"
rows="4"
required><?php echo htmlspecialchars($project['proj_disc'] ?? ''); ?></textarea>
</div>

</div><br>

<div class="form-group row">
<label class="col-sm-4 col-form-label">
Start Date
</label>

<div class="col-sm-10">
<input
type="date"
name="proj_start_date"
value="<?php echo $row['proj_start_date']; ?>"
class="form-control"
required>
</div>
</div>

<br>



<br> 



<br> 

<button type="submit"
name ="update"
class="btn btn-success">
update 
</button>

</form>
</div>

</div>
</div>
</div>
</div>
<?php

if(isset($_POST['update'])){

$name = $_POST['proj_name'];
$start = $_POST['proj_start_date'];
$deadline = $_POST['proj_deadline'];
$desc = $_POST['proj_disc'];

$conn->query("
UPDATE projects SET
proj_name='$name',
proj_start_date='$start',
proj_deadline='$deadline',
proj_disc='$desc'   
WHERE proj_id=$id
");

header("Location: project_form.php");
exit;

}

?>