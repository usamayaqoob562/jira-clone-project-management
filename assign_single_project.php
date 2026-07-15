<<<<<<< HEAD
<head>
<link rel="stylesheet" href="style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


</head>

<?php
include 'conn.php';

if(!isset($_GET['id'])){
    die("Project ID missing");
}

$project_id = $_GET['id'];

$project = $conn->query("
SELECT * FROM projects 
WHERE proj_id='$project_id'
");

$p = $project->fetch_assoc();

$users = $conn->query("
SELECT * FROM users
");

if(isset($_POST['assign_users'])){

    $selected_users = $_POST['users'] ?? [];

    if(!empty($selected_users)){

        foreach($selected_users as $user_id){

            $conn->query("
            INSERT INTO project_assign_users(project_id,user_id)
            VALUES('$project_id','$user_id')
            ");
        }

        header("Location: project_detail.php?id=$project_id");
        exit;

    }else{
        $msg = "Please select at least one user";
    }
}
?>

<div class="main_single_user">

<div class="assign-form shadow bg-dark text-white">

<h2 class="mb-4">Assign Users to Project</h2>

<p>
<b>Project:</b> <?php echo $p['proj_name']; ?>
</p>

<form method="POST">

<div class="mb-3">
<label class="form-label">Search User</label>
<input type="text"
       id="userSearch"
       class="form-control"
       placeholder="Search user name">
</div>

<div class="mb-3">
<label class="form-label">Select Users</label>

<select name="users[]"
        id="usersList"
        class="form-control"
        multiple
        required
        style="height:180px;">

<?php while($u = $users->fetch_assoc()) { ?>
<option value="<?php echo $u['user_id']; ?>">
<?php echo $u['user_name']; ?>
</option>
<?php } ?>

</select>
</div>

<div class="btn-area">
<button type="submit"
        name="assign_users"
        class="btn btn-success">
Assign Users
</button>
</div>

</form>

</div>
</div>

<script>

document.getElementById("userSearch")
.addEventListener("keyup", function () {

let filter = this.value.toLowerCase();

let options =
document.getElementById("usersList").options;

for (let i = 0; i < options.length; i++) {

let text = options[i].text.toLowerCase();

options[i].style.display =
text.includes(filter) ? "" : "none";
}

});

=======
<head>
<link rel="stylesheet" href="style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


</head>

<?php
include 'conn.php';

if(!isset($_GET['id'])){
    die("Project ID missing");
}

$project_id = $_GET['id'];

$project = $conn->query("
SELECT * FROM projects 
WHERE proj_id='$project_id'
");

$p = $project->fetch_assoc();

$users = $conn->query("
SELECT * FROM users
");

if(isset($_POST['assign_users'])){

    $selected_users = $_POST['users'] ?? [];

    if(!empty($selected_users)){

        foreach($selected_users as $user_id){

            $conn->query("
            INSERT INTO project_assign_users(project_id,user_id)
            VALUES('$project_id','$user_id')
            ");
        }

        header("Location: project_detail.php?id=$project_id");
        exit;

    }else{
        $msg = "Please select at least one user";
    }
}
?>

<div class="main_single_user">

<div class="assign-form shadow bg-dark text-white">

<h2 class="mb-4">Assign Users to Project</h2>

<p>
<b>Project:</b> <?php echo $p['proj_name']; ?>
</p>

<form method="POST">

<div class="mb-3">
<label class="form-label">Search User</label>
<input type="text"
       id="userSearch"
       class="form-control"
       placeholder="Search user name">
</div>

<div class="mb-3">
<label class="form-label">Select Users</label>

<select name="users[]"
        id="usersList"
        class="form-control"
        multiple
        required
        style="height:180px;">

<?php while($u = $users->fetch_assoc()) { ?>
<option value="<?php echo $u['user_id']; ?>">
<?php echo $u['user_name']; ?>
</option>
<?php } ?>

</select>
</div>

<div class="btn-area">
<button type="submit"
        name="assign_users"
        class="btn btn-success">
Assign Users
</button>
</div>

</form>

</div>
</div>

<script>

document.getElementById("userSearch")
.addEventListener("keyup", function () {

let filter = this.value.toLowerCase();

let options =
document.getElementById("usersList").options;

for (let i = 0; i < options.length; i++) {

let text = options[i].text.toLowerCase();

options[i].style.display =
text.includes(filter) ? "" : "none";
}

});

>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
</script>