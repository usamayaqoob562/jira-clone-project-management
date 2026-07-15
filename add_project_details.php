<<<<<<< HEAD
<head>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
include 'conn.php';
include 'bootstrapslink.php';

$msg = "";
$selected_project = $_GET['id'] ?? '';

if(isset($_POST['assign_project'])){

    $project_id = $_POST['project_id'] ?? '';
    $users = $_POST['users'] ?? [];

    if($project_id && !empty($users)){

        foreach($users as $user_id){

            $sql = "INSERT INTO project_assign_users (project_id, user_id)
                    VALUES ('$project_id', '$user_id')";

            $conn->query($sql);
        }

header("Location: project_detail.php");
    }
    else{
        $msg = "❌ Please select project and users";
    }
}

$projects = $conn->query("
    SELECT * FROM projects
    WHERE proj_id NOT IN (
        SELECT project_id FROM project_assign_users
    )
");
$users = $conn->query("SELECT * FROM users");
?>

<?php if($msg){ ?>
<p><?php echo $msg; ?></p>
<?php } ?>

<div class="tasks_form_container">

<div class="tasks_form_main">

    <h1>Assign Project</h1>
    <br>

    <div class="Assign_tasks_form">

<form method="POST">

<div class="form-group row"><br>
    <label class="col-sm-4 col-form-label">
        Project Name
    </label>

    <div class="col-sm-10">
        <select name="project_id" class="form-control" required>
            <option value="">Select Project</option>

            <?php while($p = $projects->fetch_assoc()) { ?>
                <option value="<?php echo $p['proj_id']; ?>">
                    <?php echo $p['proj_name']; ?>
                </option>
            <?php } ?>

        </select>
    </div>
</div>

<br>

<div class="form-group row">
    <label class="col-sm-4 col-form-label">
        Search User
    </label>

    <div class="col-sm-10">
        <input type="text"
               id="userSearch"
               class="form-control"
               placeholder="Enter user name to search">
    </div>
</div>

<br>

<div class="form-group row">
    <label class="col-sm-4 col-form-label">
        Assign Users
    </label>

    <div class="col-sm-10">
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

        <small class="text-white">
           To select Multiple users  press CTRL and click
        </small>
    </div>
</div>

<br>

<button type="submit"
        name="assign_project"
        class="btn btn-success">

    Assign 

</button>

</form>

    </div>

</div>

</div>

<script>
document.getElementById("userSearch").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let options = document.getElementById("usersList").options;

    for (let i = 0; i < options.length; i++) {
        let text = options[i].text.toLowerCase();

        if (text.includes(filter)) {
            options[i].style.display = "";
        } else {
            options[i].style.display = "none";
        }
    }
});
=======
<head>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
include 'conn.php';
include 'bootstrapslink.php';

$msg = "";
$selected_project = $_GET['id'] ?? '';

if(isset($_POST['assign_project'])){

    $project_id = $_POST['project_id'] ?? '';
    $users = $_POST['users'] ?? [];

    if($project_id && !empty($users)){

        foreach($users as $user_id){

            $sql = "INSERT INTO project_assign_users (project_id, user_id)
                    VALUES ('$project_id', '$user_id')";

            $conn->query($sql);
        }

header("Location: project_detail.php");
    }
    else{
        $msg = "❌ Please select project and users";
    }
}

$projects = $conn->query("
    SELECT * FROM projects
    WHERE proj_id NOT IN (
        SELECT project_id FROM project_assign_users
    )
");
$users = $conn->query("SELECT * FROM users");
?>

<?php if($msg){ ?>
<p><?php echo $msg; ?></p>
<?php } ?>

<div class="tasks_form_container">

<div class="tasks_form_main">

    <h1>Assign Project</h1>
    <br>

    <div class="Assign_tasks_form">

<form method="POST">

<div class="form-group row"><br>
    <label class="col-sm-4 col-form-label">
        Project Name
    </label>

    <div class="col-sm-10">
        <select name="project_id" class="form-control" required>
            <option value="">Select Project</option>

            <?php while($p = $projects->fetch_assoc()) { ?>
                <option value="<?php echo $p['proj_id']; ?>">
                    <?php echo $p['proj_name']; ?>
                </option>
            <?php } ?>

        </select>
    </div>
</div>

<br>

<div class="form-group row">
    <label class="col-sm-4 col-form-label">
        Search User
    </label>

    <div class="col-sm-10">
        <input type="text"
               id="userSearch"
               class="form-control"
               placeholder="Enter user name to search">
    </div>
</div>

<br>

<div class="form-group row">
    <label class="col-sm-4 col-form-label">
        Assign Users
    </label>

    <div class="col-sm-10">
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

        <small class="text-white">
           To select Multiple users  press CTRL and click
        </small>
    </div>
</div>

<br>

<button type="submit"
        name="assign_project"
        class="btn btn-success">

    Assign 

</button>

</form>

    </div>

</div>

</div>

<script>
document.getElementById("userSearch").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let options = document.getElementById("usersList").options;

    for (let i = 0; i < options.length; i++) {
        let text = options[i].text.toLowerCase();

        if (text.includes(filter)) {
            options[i].style.display = "";
        } else {
            options[i].style.display = "none";
        }
    }
});
>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
</script>