<?php

$conn = new mysqli("localhost","root","","jiraclone");

if($conn->connect_error){
die("DB Connection Failed");
}

/* 🔴 STEP 1: check form submit */
if($_SERVER["REQUEST_METHOD"] == "POST"){

echo "Form Received <br>"; // debug line

$email = $_POST['email'] ?? '';
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$username = $_POST['username'] ?? '';

/* 🔴 STEP 2: check data */
if($email=="" || $password=="" || $username==""){
die("Missing Fields");
}

/* 🔴 STEP 3: insert */
$sql = "INSERT INTO users(user_name,email,password)
VALUES('$username','$email','$password')";

if($conn->query($sql)){
    
echo "User Inserted Successfully";
header("Location: login.html");

}else{
echo "Error: ".$conn->error;
}

}else{
echo "No POST Request";
}

?>