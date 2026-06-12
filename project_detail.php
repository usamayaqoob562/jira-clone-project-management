<<<<<<< HEAD
<head>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
include 'conn.php';
include 'sidebar.php';

$id = $_GET['id'] ?? '';

if($id != ''){

    $sql = "
    SELECT 
        project_assign_users.id AS assign_id,
        projects.proj_id,
        projects.proj_name,
        users.user_name
    FROM project_assign_users
    JOIN projects 
    ON project_assign_users.project_id = projects.proj_id
    JOIN users 
    ON project_assign_users.user_id = users.user_id
    WHERE projects.proj_id = '$id'
    ";

}else{

    $sql = "
    SELECT 
        project_assign_users.id AS assign_id,
        projects.proj_id,
        projects.proj_name,
        users.user_name
    FROM project_assign_users
    JOIN projects 
    ON project_assign_users.project_id = projects.proj_id
    JOIN users 
    ON project_assign_users.user_id = users.user_id
    ";
}

$result = $conn->query($sql);

if(!$result){
    die("SQL Error: " . $conn->error);
}

$has_data = $result->num_rows;
?>

<div class="project_detail_main">

<div class="details_heading">

    <h2>Project Users</h2>

    <?php if($has_data > 0) { ?>

    <a href="assign_single_project.php?id=<?php echo $id; ?>"
       class="btn btn-success btn-sm">

        Add Users

    </a>

    <?php } ?>

</div>




<div class="container mt-5 bg-light p-4">

<table class="table table-striped table-bordered">

<thead class="table-light">
<tr>
    <th>Assigned Users</th>
    <th>Actions</th>
</tr>
</thead>

<tbody>

<?php if($has_data == 0) { ?>

<tr>
<td colspan="2" class="text-center">
    No project details found
    <br><br>

    <a href="assign_single_project.php?id=<?php echo $id; ?>"
       class="btn btn-success btn-sm">
        Assign This Project
    </a>
</td>
</tr>

<?php } else { ?>

<?php $count = 0; ?>

<?php while($row = $result->fetch_assoc()) { 
$count++;
?>

<tr>
    <td>
        <?php echo $row['user_name']; ?>
    </td>

    <td>
        <a href="remove_project.php?assign_id=<?php echo $row['assign_id']; ?>&project_id=<?php echo $row['proj_id']; ?>"
           class="btn btn-danger btn-sm"
           onclick="return confirm('Are you sure?')">
            Remove
        </a>

        
    </td>
</tr>

<?php } ?>

<?php } ?>

</tbody>

</table>

<a href="project_form.php"
   class="btn btn-secondary btn-sm">
    Back
</a>

</div>

=======
<head>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
include 'conn.php';
include 'sidebar.php';

$id = $_GET['id'] ?? '';

if($id != ''){

    $sql = "
    SELECT 
        project_assign_users.id AS assign_id,
        projects.proj_id,
        projects.proj_name,
        users.user_name
    FROM project_assign_users
    JOIN projects 
    ON project_assign_users.project_id = projects.proj_id
    JOIN users 
    ON project_assign_users.user_id = users.user_id
    WHERE projects.proj_id = '$id'
    ";

}else{

    $sql = "
    SELECT 
        project_assign_users.id AS assign_id,
        projects.proj_id,
        projects.proj_name,
        users.user_name
    FROM project_assign_users
    JOIN projects 
    ON project_assign_users.project_id = projects.proj_id
    JOIN users 
    ON project_assign_users.user_id = users.user_id
    ";
}

$result = $conn->query($sql);

if(!$result){
    die("SQL Error: " . $conn->error);
}

$has_data = $result->num_rows;
?>

<div class="project_detail_main">

<div class="details_heading">

    <h2>Project Users</h2>

    <?php if($has_data > 0) { ?>

    <a href="assign_single_project.php?id=<?php echo $id; ?>"
       class="btn btn-success btn-sm">

        Add Users

    </a>

    <?php } ?>

</div>




<div class="container mt-5 bg-light p-4">

<table class="table table-striped table-bordered">

<thead class="table-light">
<tr>
    <th>Assigned Users</th>
    <th>Actions</th>
</tr>
</thead>

<tbody>

<?php if($has_data == 0) { ?>

<tr>
<td colspan="2" class="text-center">
    No project details found
    <br><br>

    <a href="assign_single_project.php?id=<?php echo $id; ?>"
       class="btn btn-success btn-sm">
        Assign This Project
    </a>
</td>
</tr>

<?php } else { ?>

<?php $count = 0; ?>

<?php while($row = $result->fetch_assoc()) { 
$count++;
?>

<tr>
    <td>
        <?php echo $row['user_name']; ?>
    </td>

    <td>
        <a href="remove_project.php?assign_id=<?php echo $row['assign_id']; ?>&project_id=<?php echo $row['proj_id']; ?>"
           class="btn btn-danger btn-sm"
           onclick="return confirm('Are you sure?')">
            Remove
        </a>

        
    </td>
</tr>

<?php } ?>

<?php } ?>

</tbody>

</table>

<a href="project_form.php"
   class="btn btn-secondary btn-sm">
    Back
</a>

</div>

>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
</div>