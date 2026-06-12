
<?php

session_start();

if(isset($_SESSION['user_id']))
{
    header("Location: dashboard.php");
    exit();
}

include 'conn.php';


$error = "";

if(isset($_POST['login']))
{
    $login = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = $conn->query("
        SELECT * FROM users 
        WHERE user_name='$login' OR email='$login'
    ");

    if($result->num_rows > 0)
    {
        $user = $result->fetch_assoc();

        if($password == $user['password'] || password_verify($password, $user['password']))
        {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['user_name'];

            header("Location: dashboard.php");
            exit();
        }
        else
        {
            $error = "❌ Wrong Password";
        }
    }
    else
    {
        $error = "❌ User not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body>

<div class="login_container">

<div class="main_login">

<h1>Login</h1>

<?php if($error != "") { ?>
    <p class="text-danger"><?php echo $error; ?></p>
<?php } ?>

<div class="login_form">

<form method="POST" action="login.php">

<div class="form-group row"><br>

<label class="col-md-4 col-form-label">
Username
</label><br>

<div class="col-sm-10">
<input type="text"
       name="username"
       class="form-control"
       placeholder="Enter username or email"
       required>
</div>

</div>

<div class="form-group row"><br>

<label class="col-sm-4 col-form-label">
Password
</label><br>

<div class="col-sm-10">
<input type="password"
       name="password"
       class="form-control"
       placeholder="Enter your password"
       required>
</div>

</div><br>

<button type="submit"
        name="login"
        class="btn btn-success">
Login
</button>

<a href="signup.html" class="btn">
Create New Account
</a>

</form>

</div>

</div>

</div>

</body>
</html>