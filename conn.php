<<<<<<< HEAD
<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "jiraclone";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    
}

?>
=======
<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "jiraclone";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    
}

?>
>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
