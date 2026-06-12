<<<<<<< HEAD
<head>
    <title>Jira Clone</title>

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<?php
include 'conn.php'; 
include 'sidebar.php';
?>
<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

/* Browser Cache Disable */

header("Cache-Control: no-cache, no-store, must-revalidate");

header("Pragma: no-cache");

header("Expires: 0");

?>

<style>
    * {
        overflow-x: hidden;
    }
</style>


<div class="row">
    <div class="col-4">
    </div>



    <div class="projects_main" style="margin-left:250px; width:80%;">

    <div class="d-flex justify-content-between align-items-center">

        <form method="GET" class="d-flex mt-1" style="width:40%;">

            <input type="text"
                name="search"
                class="form-control"
                placeholder="Search project by name..."
                value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

            <button type="submit"
                class="btn btn-success ms-2">

                Search

            </button>

        </form>

        <button
        class="btn btn-success"
        data-bs-toggle="modal"
        data-bs-target="#addProjectModal">

        Add Project

        </button>

    </div>

</div>

    </div>


    <div class="projectstable">

        <?php
        $limit = 10;

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $search = $_GET['search'] ?? '';

        if ($search != '') {
            $page = 1; // fix pagination bug
        }

        $start = ($page - 1) * $limit;

        /* 🔥 ALWAYS assign $projects */
        if ($search != '') {
            $projects = $conn->query("
    SELECT * FROM projects 
    WHERE proj_name LIKE '%$search%' 
    LIMIT $start, $limit
    ");
        } else {
            $projects = $conn->query("
    SELECT * FROM projects 
    LIMIT $start, $limit
    ");
        }


        ?>

        <table class="table table-bordered table-striped">

            <tr class="text-center">
                <th>ID</th>
                <th>Project Name</th>
                <th>Actions</th>
            </tr>

            <tbody>

                <?php while ($p = $projects->fetch_assoc()) { ?>

                    <tr class="text-center">

                        <td>
                            <?php echo $p['proj_id']; ?>
                        </td>

                        <td>
                            <?php echo $p['proj_name']; ?>
                        </td>

                        <td>

                            <button

                                class="btn btn-success btn-sm"

                                data-bs-toggle="modal"
                                data-bs-target="#editProjectModal"

                                data-id="<?php echo $p['proj_id']; ?>"

                                data-name="<?php echo $p['proj_name']; ?>"

                                data-desc="<?php echo isset($p['proj_disc']) ? $p['proj_disc'] : ''; ?>">

                                Edit

                            </button>

                            <a href="delete_project.php?id=<?php echo $p['proj_id']; ?>"
                                class="btn btn-danger btn-sm">
                                Delete
                            </a>

                            <button
                                class="btn btn-info btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#viewModal"
                                data-id="<?php echo $p['proj_id']; ?>"
                                data-name="<?php echo htmlspecialchars($p['proj_name']); ?>"
                                data-desc="<?php echo isset($p['proj_disc']) ? htmlspecialchars($p['proj_disc']) : ''; ?>">
                                View
                            </button>

                            <a href="project_detail.php?id=<?php echo $p['proj_id']; ?>"
                                class="btn btn-dark btn-sm">
                                Users
                            </a>

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>
        <div class="modal fade" id="addProjectModal">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST" action="add_project_action.php">

<div class="modal-header">

<h5 class="modal-title">Add Project</h5>

<button type="button "
class="btn-close"
data-bs-dismiss="modal"></button>

</div>

<div class="modal-body">

<label>Project Name</label>
<input type="text"
name="proj_name"
class="form-control"
required>

<br>

<label>Project Description</label>
<textarea name="proj_disc"
class="form-control"></textarea>

<br>

<label>Start Date</label>
<input type="date"
name="proj_start_date"
class="form-control"
required>

<br>

<label>Deadline</label>
<input type="date"
name="proj_deadline"
class="form-control"
required>

</div>

<div class="modal-footer">

<button type="submit"
name="add_project"
class="btn btn-success">
Add Project
</button>

</div>

</form>

</div>

</div>

</div>
        <div class="modal fade" id="editProjectModal">

            <div class="modal-dialog">

                <div class="modal-content">

                    <form method="POST" action="update_project.php">

                        <div class="modal-header">

                            <h5 class="modal-title">

                                Edit Project

                            </h5>

                            <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">

                            </button>

                        </div>

                        <div class="modal-body">

                            <input type="hidden"
                                name="proj_id"
                                id="edit_proj_id">

                            <label>Project Name</label>

                            <input type="text"
                                name="proj_name"
                                id="edit_proj_name"
                                class="form-control">

                            <br>

                            <label>Project Description</label>

                            <textarea
                                name="proj_disc"
                                id="edit_proj_disc"
                                class="form-control"></textarea>

                        </div>

                        <div class="modal-footer">

                            <button type="submit"
                                class="btn btn-success">

                                Update Project

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
        <div class="modal fade" id="viewModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Project Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p><strong>ID:</strong> <span id="m_id"></span></p>
                        <p><strong>Name:</strong> <span id="m_name"></span></p>
                        <p><strong>Description:</strong> <span id="m_desc"></span></p>
                    </div>

                </div>
            </div>
        </div>

        <?php

        /* 🔴 TOTAL RECORDS */
        $search = $_GET['search'] ?? '';

        $total_query = $conn->query("
SELECT COUNT(*) as total FROM projects 
WHERE proj_name LIKE '%$search%'");

        $total_row = $total_query->fetch_assoc();
        $total_records = $total_row['total'];
        $total_pages = ceil($total_records / $limit);
        $total_records = $total_row['total'];

        /* 🔴 TOTAL PAGES */
        $total_pages = ceil($total_records / $limit);

        ?>
        <div class="pagination-projects">
            <!-- 🔥 Pagination UI -->
            <div class="d-flex  ">

                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>

                    <a href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>"
                        class="btn btn-sm btn-secondary mx-1">
                        <?php echo $i; ?>
                    </a>
            </div>

        <?php } ?>

        </div>

    </div>

</div>


</div>


<script>
    var modal = document.getElementById('viewModal');

    modal.addEventListener('show.bs.modal', function(event) {

        var button = event.relatedTarget;

        document.getElementById('m_id').innerText =
            button.getAttribute('data-id');

        document.getElementById('m_name').innerText =
            button.getAttribute('data-name');

        document.getElementById('m_desc').innerText =
            button.getAttribute('data-desc');

    });



    var editProjectModal =
        document.getElementById('editProjectModal');

    editProjectModal.addEventListener('show.bs.modal', function(event) {

        var button = event.relatedTarget;

        document.getElementById('edit_proj_id').value =
            button.getAttribute('data-id');

        document.getElementById('edit_proj_name').value =
            button.getAttribute('data-name');

        document.getElementById('edit_proj_disc').value =
            button.getAttribute('data-desc');

    });
=======
<head>
    <title>Jira Clone</title>

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<?php
include 'conn.php'; 
include 'sidebar.php';
?>
<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

/* Browser Cache Disable */

header("Cache-Control: no-cache, no-store, must-revalidate");

header("Pragma: no-cache");

header("Expires: 0");

?>

<style>
    * {
        overflow-x: hidden;
    }
</style>


<div class="row">
    <div class="col-4">
    </div>



    <div class="projects_main" style="margin-left:250px; width:80%;">

    <div class="d-flex justify-content-between align-items-center">

        <form method="GET" class="d-flex mt-1" style="width:40%;">

            <input type="text"
                name="search"
                class="form-control"
                placeholder="Search project by name..."
                value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

            <button type="submit"
                class="btn btn-success ms-2">

                Search

            </button>

        </form>

        <button
        class="btn btn-success"
        data-bs-toggle="modal"
        data-bs-target="#addProjectModal">

        Add Project

        </button>

    </div>

</div>

    </div>


    <div class="projectstable">

        <?php
        $limit = 10;

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $search = $_GET['search'] ?? '';

        if ($search != '') {
            $page = 1; // fix pagination bug
        }

        $start = ($page - 1) * $limit;

        /* 🔥 ALWAYS assign $projects */
        if ($search != '') {
            $projects = $conn->query("
    SELECT * FROM projects 
    WHERE proj_name LIKE '%$search%' 
    LIMIT $start, $limit
    ");
        } else {
            $projects = $conn->query("
    SELECT * FROM projects 
    LIMIT $start, $limit
    ");
        }


        ?>

        <table class="table table-bordered table-striped">

            <tr class="text-center">
                <th>ID</th>
                <th>Project Name</th>
                <th>Actions</th>
            </tr>

            <tbody>

                <?php while ($p = $projects->fetch_assoc()) { ?>

                    <tr class="text-center">

                        <td>
                            <?php echo $p['proj_id']; ?>
                        </td>

                        <td>
                            <?php echo $p['proj_name']; ?>
                        </td>

                        <td>

                            <button

                                class="btn btn-success btn-sm"

                                data-bs-toggle="modal"
                                data-bs-target="#editProjectModal"

                                data-id="<?php echo $p['proj_id']; ?>"

                                data-name="<?php echo $p['proj_name']; ?>"

                                data-desc="<?php echo isset($p['proj_disc']) ? $p['proj_disc'] : ''; ?>">

                                Edit

                            </button>

                            <a href="delete_project.php?id=<?php echo $p['proj_id']; ?>"
                                class="btn btn-danger btn-sm">
                                Delete
                            </a>

                            <button
                                class="btn btn-info btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#viewModal"
                                data-id="<?php echo $p['proj_id']; ?>"
                                data-name="<?php echo htmlspecialchars($p['proj_name']); ?>"
                                data-desc="<?php echo isset($p['proj_disc']) ? htmlspecialchars($p['proj_disc']) : ''; ?>">
                                View
                            </button>

                            <a href="project_detail.php?id=<?php echo $p['proj_id']; ?>"
                                class="btn btn-dark btn-sm">
                                Users
                            </a>

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>
        <div class="modal fade" id="addProjectModal">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST" action="add_project_action.php">

<div class="modal-header">

<h5 class="modal-title">Add Project</h5>

<button type="button "
class="btn-close"
data-bs-dismiss="modal"></button>

</div>

<div class="modal-body">

<label>Project Name</label>
<input type="text"
name="proj_name"
class="form-control"
required>

<br>

<label>Project Description</label>
<textarea name="proj_disc"
class="form-control"></textarea>

<br>

<label>Start Date</label>
<input type="date"
name="proj_start_date"
class="form-control"
required>

<br>

<label>Deadline</label>
<input type="date"
name="proj_deadline"
class="form-control"
required>

</div>

<div class="modal-footer">

<button type="submit"
name="add_project"
class="btn btn-success">
Add Project
</button>

</div>

</form>

</div>

</div>

</div>
        <div class="modal fade" id="editProjectModal">

            <div class="modal-dialog">

                <div class="modal-content">

                    <form method="POST" action="update_project.php">

                        <div class="modal-header">

                            <h5 class="modal-title">

                                Edit Project

                            </h5>

                            <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">

                            </button>

                        </div>

                        <div class="modal-body">

                            <input type="hidden"
                                name="proj_id"
                                id="edit_proj_id">

                            <label>Project Name</label>

                            <input type="text"
                                name="proj_name"
                                id="edit_proj_name"
                                class="form-control">

                            <br>

                            <label>Project Description</label>

                            <textarea
                                name="proj_disc"
                                id="edit_proj_disc"
                                class="form-control"></textarea>

                        </div>

                        <div class="modal-footer">

                            <button type="submit"
                                class="btn btn-success">

                                Update Project

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
        <div class="modal fade" id="viewModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Project Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p><strong>ID:</strong> <span id="m_id"></span></p>
                        <p><strong>Name:</strong> <span id="m_name"></span></p>
                        <p><strong>Description:</strong> <span id="m_desc"></span></p>
                    </div>

                </div>
            </div>
        </div>

        <?php

        /* 🔴 TOTAL RECORDS */
        $search = $_GET['search'] ?? '';

        $total_query = $conn->query("
SELECT COUNT(*) as total FROM projects 
WHERE proj_name LIKE '%$search%'");

        $total_row = $total_query->fetch_assoc();
        $total_records = $total_row['total'];
        $total_pages = ceil($total_records / $limit);
        $total_records = $total_row['total'];

        /* 🔴 TOTAL PAGES */
        $total_pages = ceil($total_records / $limit);

        ?>
        <div class="pagination-projects">
            <!-- 🔥 Pagination UI -->
            <div class="d-flex  ">

                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>

                    <a href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>"
                        class="btn btn-sm btn-secondary mx-1">
                        <?php echo $i; ?>
                    </a>
            </div>

        <?php } ?>

        </div>

    </div>

</div>


</div>


<script>
    var modal = document.getElementById('viewModal');

    modal.addEventListener('show.bs.modal', function(event) {

        var button = event.relatedTarget;

        document.getElementById('m_id').innerText =
            button.getAttribute('data-id');

        document.getElementById('m_name').innerText =
            button.getAttribute('data-name');

        document.getElementById('m_desc').innerText =
            button.getAttribute('data-desc');

    });



    var editProjectModal =
        document.getElementById('editProjectModal');

    editProjectModal.addEventListener('show.bs.modal', function(event) {

        var button = event.relatedTarget;

        document.getElementById('edit_proj_id').value =
            button.getAttribute('data-id');

        document.getElementById('edit_proj_name').value =
            button.getAttribute('data-name');

        document.getElementById('edit_proj_disc').value =
            button.getAttribute('data-desc');

    });
>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
</script>