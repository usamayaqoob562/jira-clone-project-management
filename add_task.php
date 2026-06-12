<<<<<<< HEAD
<head>
    <link rel="stylesheet" href="style.css">
</head>

<?php
include 'conn.php';
include 'bootstrapslink.php';

$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $task_name = $_POST['task_name'] ?? '';
    $proj_id   = $_POST['proj_id'] ?? '';
    $deadline  = $_POST['deadline'] ?? '';

    if($task_name && $proj_id && $deadline){

        $sql = "
        INSERT INTO tasks 
        (task_name, proj_id, deadline)
        VALUES 
        ('$task_name', '$proj_id', '$deadline')
        ";

        if($conn->query($sql)){
            header("Location: tasks_list.php");
            exit();
        }else{
            $msg = "❌ Error: ".$conn->error;
        }

    }else{
        $msg = "❌ All fields are required";
    }
}

$projects = $conn->query("SELECT * FROM projects");
?>

<?php if($msg){ ?>
<p><?php echo $msg; ?></p>
<?php } ?>

<div class="tasks_form_container">

<div class="tasks_form_main">

<h1>Add Task</h1>
<br>

<div class="tasks_form">

<form method="POST">

<div class="form-group row">
<label class="col-sm-4 col-form-label">Task Name</label>

<div class="col-sm-10">
<input type="text"
       name="task_name"
       class="form-control"
       required>
</div>
</div>

<br>

<div class="form-group row">
<label class="col-sm-4 col-form-label">Select Project</label>

<div class="col-sm-10">
<select name="proj_id"
        class="form-control"
        required>

<option value="">Select Project</option>

<?php while ($p = $projects->fetch_assoc()) { ?>
<option value="<?php echo $p['proj_id']; ?>">
<?php echo $p['proj_name']; ?>
</option>
<?php } ?>

</select>
</div>
</div>

<br>

<div class="form-group row">
<label class="col-sm-4 col-form-label">Deadline</label>

<div class="col-sm-10">
<input type="date"
       name="deadline"
       class="form-control"
       required>
</div>
</div>

<br>

<button type="submit" class="btn btn-success">
Add Task
</button>

</form>

</div>
</div>
=======
<head>
    <link rel="stylesheet" href="style.css">
</head>

<?php
include 'conn.php';
include 'bootstrapslink.php';

$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $task_name = $_POST['task_name'] ?? '';
    $proj_id   = $_POST['proj_id'] ?? '';
    $deadline  = $_POST['deadline'] ?? '';

    if($task_name && $proj_id && $deadline){

        $sql = "
        INSERT INTO tasks 
        (task_name, proj_id, deadline)
        VALUES 
        ('$task_name', '$proj_id', '$deadline')
        ";

        if($conn->query($sql)){
            header("Location: tasks_list.php");
            exit();
        }else{
            $msg = "❌ Error: ".$conn->error;
        }

    }else{
        $msg = "❌ All fields are required";
    }
}

$projects = $conn->query("SELECT * FROM projects");
?>

<?php if($msg){ ?>
<p><?php echo $msg; ?></p>
<?php } ?>

<div class="tasks_form_container">

<div class="tasks_form_main">

<h1>Add Task</h1>
<br>

<div class="tasks_form">

<form method="POST">

<div class="form-group row">
<label class="col-sm-4 col-form-label">Task Name</label>

<div class="col-sm-10">
<input type="text"
       name="task_name"
       class="form-control"
       required>
</div>
</div>

<br>

<div class="form-group row">
<label class="col-sm-4 col-form-label">Select Project</label>

<div class="col-sm-10">
<select name="proj_id"
        class="form-control"
        required>

<option value="">Select Project</option>

<?php while ($p = $projects->fetch_assoc()) { ?>
<option value="<?php echo $p['proj_id']; ?>">
<?php echo $p['proj_name']; ?>
</option>
<?php } ?>

</select>
</div>
</div>

<br>

<div class="form-group row">
<label class="col-sm-4 col-form-label">Deadline</label>

<div class="col-sm-10">
<input type="date"
       name="deadline"
       class="form-control"
       required>
</div>
</div>

<br>

<button type="submit" class="btn btn-success">
Add Task
</button>

</form>

</div>
</div>
>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
</div>