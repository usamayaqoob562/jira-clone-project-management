<<<<<<< HEAD
<head>
    <link rel="stylesheet" href="style.css">
</head><?php

include 'conn.php';

$id = $_GET['id'];

$user = $conn->query("SELECT * FROM users WHERE user_id=$id");

$data = $user->fetch_assoc();

/* Update */

if(isset($_POST['update_user']))
{
    $name = $_POST['user_name'];
    $rank = $_POST['user_rank'];

    $conn->query("
        UPDATE users
        SET user_name='$name',
            user_rank='$rank'
        WHERE user_id=$id
    ");

    header("Location: users.php");
}

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="useredit_main">

<div class="edituser_form">
<form method="POST">

<label>User Name</label>

<input type="text"
       name="user_name"
       class="form-control"
       value="<?php echo $data['user_name']; ?>">

       <div class="mb-3">

<label class="form-label">User Role</label>

<select name="user_rank"
        class="form-control">

<option value="Admin">Admin</option>

<option value="Manager">Manager</option>

<option value="Employee">Employee</option>

</select>

</div>






<button type="submit"
        name="update_user"
        class="btn btn-success">

Update

</button>

</form>

</div>

=======
<head>
    <link rel="stylesheet" href="style.css">
</head><?php

include 'conn.php';

$id = $_GET['id'];

$user = $conn->query("SELECT * FROM users WHERE user_id=$id");

$data = $user->fetch_assoc();

/* Update */

if(isset($_POST['update_user']))
{
    $name = $_POST['user_name'];
    $rank = $_POST['user_rank'];

    $conn->query("
        UPDATE users
        SET user_name='$name',
            user_rank='$rank'
        WHERE user_id=$id
    ");

    header("Location: users.php");
}

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="useredit_main">

<div class="edituser_form">
<form method="POST">

<label>User Name</label>

<input type="text"
       name="user_name"
       class="form-control"
       value="<?php echo $data['user_name']; ?>">

       <div class="mb-3">

<label class="form-label">User Role</label>

<select name="user_rank"
        class="form-control">

<option value="Admin">Admin</option>

<option value="Manager">Manager</option>

<option value="Employee">Employee</option>

</select>

</div>






<button type="submit"
        name="update_user"
        class="btn btn-success">

Update

</button>

</form>

</div>

>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
