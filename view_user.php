<?php

include 'conn.php';

$id = $_GET['id'];

$user = $conn->query("SELECT * FROM users WHERE user_id=$id");

$data = $user->fetch_assoc();

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">

<div class="card p-4 shadow">

<h2>User Details</h2>

<p>
<b>Name:</b>
<?php echo $data['user_name']; ?>
</p>


<p>
<b>Rank:</b>
<?php echo $data['user_rank']; ?>
</p>

</div>

</div>