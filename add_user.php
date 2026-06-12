<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>

<?php

include 'conn.php';

/* Form Submit */

if(isset($_POST['add_user']))
{
    $name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rank = $_POST['user_rank'];

    /* Password Hash */

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    /* Insert Query */

    $sql = "INSERT INTO users(user_name, email, password, user_rank)
            VALUES('$name', '$email', '$hashed_password', '$rank')";

    if($conn->query($sql))
    {
        echo "<script>
                alert('User Added Successfully');
                window.location='users.php';
              </script>";
    }
    else
    {
        echo "Error: " . $conn->error;
    }
}

?>
<style>

body{
        width: 100%;
}


</style>

<div class="main_addusers">

<div class="container mt-5">

<div class="card p-4 shadow">

<h2 class="mb-4">Add User</h2>

<form method="POST">

<!-- User Name -->

<div class="mb-3">

<label class="form-label">User Name</label>

<input type="text"
       name="user_name"
       class="form-control"
       required>

</div>

<!-- Email -->

<div class="mb-3">

<label class="form-label">Email</label>

<input type="email"
       name="email"
       class="form-control"
       required>

</div>

<!-- Password -->

<div class="mb-3">

<label class="form-label">Password</label>

<input type="password"
       name="password"
       class="form-control"
       required>

</div>

<!-- User Rank -->

<div class="mb-3">

<label class="form-label">User Role</label>

<select name="user_rank"
        class="form-control">

<option value="Admin">Admin</option>

<option value="Manager">Manager</option>

<option value="Employee">Employee</option>

</select>

</div>

<!-- Button -->

<div class="text-end">

<button type="submit"
        name="add_user"
        class="btn btn-success">

Add User

</button>

</div>


</form>

</div>

</div>

</div>