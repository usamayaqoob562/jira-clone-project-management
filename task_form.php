<head>
    <title>Jira Clone</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">


    <link rel="stylesheet" href="style.css">
</head>
<?php include 'sidebar.php'; 
      include 'conn.php';
?>
<div class="main_tasks">

<div class="assign_task_container">

    

    <div class="assign_task_button">
        <h1>Assigned tasks</h1>

                <button type="button"
                    class="btn btn-success"
                    onclick="window.location.href='add_task.php'">
                    Add task            
                
                </button>



    </div>


    <div class="assigned_tasks_table">

<?php


$sql = "SELECT tasks.task_name, users.user_name, tasks.deadline
        FROM tasks
        JOIN users ON tasks.assin_to = users.user_id";

$result = $conn->query($sql);


echo "<table  border =1  cellpadding=  10 cellspacing= 0 style= width:100%";
echo "<tr>
<th>Task Name</th>
<th>User Name</th>
<th>Deadline</th>
</tr>";

while ($row = $result->fetch_assoc()) {

echo "<tr>";
echo "<td>{$row['task_name']}</td>";
echo "<td>{$row['user_name']}</td>";
echo "<td>{$row['deadline']}</td>";
echo "</tr>";

}

echo "</table>";
?>
</div>
</div>
