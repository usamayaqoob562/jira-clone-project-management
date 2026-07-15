<<<<<<< HEAD
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<?php
session_start();
include 'conn.php';
$limit = 15;

if (isset($_POST['proj_name'])) {

    $proj_name = $_POST['proj_name'];
    $start = $_POST['proj_start_date'];
     $discription = $_POST['proj_disc'];


    $user_id = $_SESSION['user_id'];
}



if (isset($_POST['proj_name'])) {

    $proj_name = $_POST['proj_name'];
    $start = $_POST['proj_start_date'];

    $discription = $_POST['proj_disc'];

    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO projects
(proj_name, proj_start_date,proj_disc, proj_comp_by)
VALUES
('$proj_name','$start','$discription','$user_id')";

    if ($conn->query($sql)) {
        header("location:project_form.php");
    } else {
        echo $conn->error;
    }
}

?>
<?php

$conn = new mysqli("localhost", "root", "", "jiraclone");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM projects";
$result = $conn->query($sql);

/* 🔴 CHECK QUERY */
if (!$result) {
    die("Query Error: " . $conn->error);
}

echo "<table class='table table-sm table-dark'>";

echo "<thead>
<tr>
<th>Project Name</th>
<th>Start Date</th>
<th>Edit</th>
<th>Delete</th>
</tr>
</thead>";

echo "<tbody>";

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<tr>";

        echo "<td>" . $row['proj_name'] . "</td>";
        echo "<td>" . $row['proj_start_date'] . "</td>";

        /* status */
       

        /* EDIT */
        echo "<td>
<a class='btn btn-warning btn-sm' href='edit_project.php?id=" . $row['proj_id'] . "'>Edit</a>
</td>";

        /* DELETE */
        echo "<td>
<button onclick='deleteProject(" . $row['proj_id'] . ")'
class='btn btn-danger btn-sm'>
Delete
</button>
</td>";

        echo "</tr>";
    }
} else {

    echo "<tr><td colspan='6'>No Projects Found</td></tr>";
}

echo "</tbody>";
echo "</table>";

?>
<script>
    function deleteProject(id) {

        if (confirm("Delete project?")) {

            fetch("delete_project.php?id=" + id)
                .then(response => response.text())
                .then(data => {
                    location.reload(); // same page refresh, no redirect feel
                });

        }

    }
=======
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<?php
session_start();
include 'conn.php';
$limit = 15;

if (isset($_POST['proj_name'])) {

    $proj_name = $_POST['proj_name'];
    $start = $_POST['proj_start_date'];
     $discription = $_POST['proj_disc'];


    $user_id = $_SESSION['user_id'];
}



if (isset($_POST['proj_name'])) {

    $proj_name = $_POST['proj_name'];
    $start = $_POST['proj_start_date'];

    $discription = $_POST['proj_disc'];

    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO projects
(proj_name, proj_start_date,proj_disc, proj_comp_by)
VALUES
('$proj_name','$start','$discription','$user_id')";

    if ($conn->query($sql)) {
        header("location:project_form.php");
    } else {
        echo $conn->error;
    }
}

?>
<?php

$conn = new mysqli("localhost", "root", "", "jiraclone");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM projects";
$result = $conn->query($sql);

/* 🔴 CHECK QUERY */
if (!$result) {
    die("Query Error: " . $conn->error);
}

echo "<table class='table table-sm table-dark'>";

echo "<thead>
<tr>
<th>Project Name</th>
<th>Start Date</th>
<th>Edit</th>
<th>Delete</th>
</tr>
</thead>";

echo "<tbody>";

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<tr>";

        echo "<td>" . $row['proj_name'] . "</td>";
        echo "<td>" . $row['proj_start_date'] . "</td>";

        /* status */
       

        /* EDIT */
        echo "<td>
<a class='btn btn-warning btn-sm' href='edit_project.php?id=" . $row['proj_id'] . "'>Edit</a>
</td>";

        /* DELETE */
        echo "<td>
<button onclick='deleteProject(" . $row['proj_id'] . ")'
class='btn btn-danger btn-sm'>
Delete
</button>
</td>";

        echo "</tr>";
    }
} else {

    echo "<tr><td colspan='6'>No Projects Found</td></tr>";
}

echo "</tbody>";
echo "</table>";

?>
<script>
    function deleteProject(id) {

        if (confirm("Delete project?")) {

            fetch("delete_project.php?id=" + id)
                .then(response => response.text())
                .then(data => {
                    location.reload(); // same page refresh, no redirect feel
                });

        }

    }
>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
</script>