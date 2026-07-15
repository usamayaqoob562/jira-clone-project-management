<<<<<<< HEAD
<head>
    <link rel="stylesheet" href="style.css">
</head>
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
<?php
include 'conn.php';

include 'bootstrapslink.php';

$page = isset($_GET['page']) ? $_GET['page'] : 1;


$limit = 10;


$start = ($page - 1) * $limit;


if (isset($_GET['search']) && $_GET['search'] != '') {
    $search = $_GET['search'];


    $users = $conn->query("
        SELECT * FROM users
        WHERE user_name LIKE '%$search%'
        LIMIT $start, $limit
    ");


    $total_result = $conn->query("
        SELECT COUNT(*) as total
        FROM users
        WHERE user_name LIKE '%$search%'
    ");
} else {

    $users = $conn->query("
        SELECT * FROM users
        LIMIT $start, $limit
    ");


    $total_result = $conn->query("
        SELECT COUNT(*) as total
        FROM users
    ");
}


$total_row = $total_result->fetch_assoc();

$total_records = $total_row['total'];

$total_pages = ceil($total_records / $limit);

?>
<style>
    * {
        overflow-x: hidden;
    }
</style>

<div class="row">
    <div class="col-2">
        <?php include 'sidebar.php'; ?>

    </div>
    <div class="col-10">
        <div class="p-3">

            <div class="d-flex justify-content-between">
                <form method="GET" class="d-flex gap-2 col-4">
                    <input type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search User Name">

                    <div class="col-4">
                        <button type="submit" class="btn btn-success">
                            Search
                        </button>
                    </div>
                </form>
                <div>

                    <button
                        class="btn btn-success"

                        data-bs-toggle="modal"
                        data-bs-target="#addUserModal">

                        Add User

                    </button>
                </div>

            </div>

            <table class="table table-bordered table-striped">

                <tr class="text-center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>

                <?php while ($u = $users->fetch_assoc()) { ?>

                    <tr>

                        <td class="text-center"><?php echo $u['user_id']; ?></td>

                        <td class="text-center"><?php echo $u['user_name']; ?></td>

                        <td class="text-center"><?php echo $u['email']; ?></td>

                        <td class="text-center">

                            <button
                                class="btn btn-success btn-sm"

                                data-bs-toggle="modal"
                                data-bs-target="#editUserModal"

                                data-id="<?php echo $u['user_id']; ?>"
                                data-name="<?php echo $u['user_name']; ?>"
                                data-email="<?php echo $u['email']; ?>">

                                Edit

                            </button>

                            <a href="delete_user.php?id=<?php echo $u['user_id']; ?>&page=<?php echo $page; ?>"
   class="btn btn-sm btn-danger"
   onclick="return confirm('Are you sure?')">
    Delete
</a>

                            <a href="view_user.php?id=<?php echo $u['user_id']; ?>"
                                class="btn btn-sm btn-info">
                                View
                            </a>

                        </td>

                    </tr>

                <?php } ?>

            </table>
            <div class="modal fade" id="addUserModal">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <form method="POST" action="add_user_action.php">

                            <div class="modal-header">

                                <h5 class="modal-title">

                                    Add User

                                </h5>

                                <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal">

                                </button>

                            </div>

                            <div class="modal-body">

                                <label>User Name</label>

                                <input type="text"
                                    name="user_name"
                                    class="form-control"
                                    required>

                                <br>

                                <label>Email</label>

                                <input type="email"
                                    name="email"
                                    class="form-control"
                                    required>

                                <br>

                                <label>Password</label>

                                <input type="password"
                                    name="password"
                                    class="form-control"
                                    required>

                                <br>

                                <label>User Role</label>

                                <select name="user_rank"
                                    class="form-control">

                                    <option value="Admin">Admin</option>

                                    <option value="Manager">Manager</option>

                                    <option value="Employee">Employee</option>

                                </select>

                            </div>

                            <div class="modal-footer">

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
            <div class="modal fade" id="editUserModal">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <form method="POST" action="update_user.php">

                            <div class="modal-header">

                                <h5 class="modal-title">
                                    Edit User
                                </h5>

                                <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal">
                                </button>

                            </div>

                            <div class="modal-body">

                                <input type="hidden"
                                    name="user_id"
                                    id="edit_user_id">

                                <label>User Name</label>

                                <input type="text"
                                    name="user_name"
                                    id="edit_user_name"
                                    class="form-control">

                                <br>

                                <label>Email</label>

                                <input type="email"
                                    name="email"
                                    id="edit_user_email"
                                    class="form-control">

                            </div>

                            <div class="modal-footer">

                                <button type="submit"
                                    class="btn btn-success">

                                    Update User

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

            <!-- Pagination Buttons -->

            <div class="mt-3 text-center">

                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>

                    <a href="users.php?page=<?php echo $i; ?>"
                        class="btn btn-secondary btn-sm">

                        <?php echo $i; ?>

                    </a>

                <?php } ?>

            </div>

        </div>
    </div>
</div>
</div>
<script>
    var editModal =
        document.getElementById('editUserModal');

    editModal.addEventListener('show.bs.modal', function(event) {

        var button = event.relatedTarget;

        document.getElementById('edit_user_id').value =
            button.getAttribute('data-id');

        document.getElementById('edit_user_name').value =
            button.getAttribute('data-name');

        document.getElementById('edit_user_email').value =
            button.getAttribute('data-email');

    });
=======
<head>
    <link rel="stylesheet" href="style.css">
</head>
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
<?php
include 'conn.php';

include 'bootstrapslink.php';

$page = isset($_GET['page']) ? $_GET['page'] : 1;


$limit = 10;


$start = ($page - 1) * $limit;


if (isset($_GET['search']) && $_GET['search'] != '') {
    $search = $_GET['search'];


    $users = $conn->query("
        SELECT * FROM users
        WHERE user_name LIKE '%$search%'
        LIMIT $start, $limit
    ");


    $total_result = $conn->query("
        SELECT COUNT(*) as total
        FROM users
        WHERE user_name LIKE '%$search%'
    ");
} else {

    $users = $conn->query("
        SELECT * FROM users
        LIMIT $start, $limit
    ");


    $total_result = $conn->query("
        SELECT COUNT(*) as total
        FROM users
    ");
}


$total_row = $total_result->fetch_assoc();

$total_records = $total_row['total'];

$total_pages = ceil($total_records / $limit);

?>
<style>
    * {
        overflow-x: hidden;
    }
</style>

<div class="row">
    <div class="col-2">
        <?php include 'sidebar.php'; ?>

    </div>
    <div class="col-10">
        <div class="p-3">

            <div class="d-flex justify-content-between">
                <form method="GET" class="d-flex gap-2 col-4">
                    <input type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search User Name">

                    <div class="col-4">
                        <button type="submit" class="btn btn-success">
                            Search
                        </button>
                    </div>
                </form>
                <div>

                    <button
                        class="btn btn-success"

                        data-bs-toggle="modal"
                        data-bs-target="#addUserModal">

                        Add User

                    </button>
                </div>

            </div>

            <table class="table table-bordered table-striped">

                <tr class="text-center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>

                <?php while ($u = $users->fetch_assoc()) { ?>

                    <tr>

                        <td class="text-center"><?php echo $u['user_id']; ?></td>

                        <td class="text-center"><?php echo $u['user_name']; ?></td>

                        <td class="text-center"><?php echo $u['email']; ?></td>

                        <td class="text-center">

                            <button
                                class="btn btn-success btn-sm"

                                data-bs-toggle="modal"
                                data-bs-target="#editUserModal"

                                data-id="<?php echo $u['user_id']; ?>"
                                data-name="<?php echo $u['user_name']; ?>"
                                data-email="<?php echo $u['email']; ?>">

                                Edit

                            </button>

                            <a href="delete_user.php?id=<?php echo $u['user_id']; ?>&page=<?php echo $page; ?>"
   class="btn btn-sm btn-danger"
   onclick="return confirm('Are you sure?')">
    Delete
</a>

                            <a href="view_user.php?id=<?php echo $u['user_id']; ?>"
                                class="btn btn-sm btn-info">
                                View
                            </a>

                        </td>

                    </tr>

                <?php } ?>

            </table>
            <div class="modal fade" id="addUserModal">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <form method="POST" action="add_user_action.php">

                            <div class="modal-header">

                                <h5 class="modal-title">

                                    Add User

                                </h5>

                                <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal">

                                </button>

                            </div>

                            <div class="modal-body">

                                <label>User Name</label>

                                <input type="text"
                                    name="user_name"
                                    class="form-control"
                                    required>

                                <br>

                                <label>Email</label>

                                <input type="email"
                                    name="email"
                                    class="form-control"
                                    required>

                                <br>

                                <label>Password</label>

                                <input type="password"
                                    name="password"
                                    class="form-control"
                                    required>

                                <br>

                                <label>User Role</label>

                                <select name="user_rank"
                                    class="form-control">

                                    <option value="Admin">Admin</option>

                                    <option value="Manager">Manager</option>

                                    <option value="Employee">Employee</option>

                                </select>

                            </div>

                            <div class="modal-footer">

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
            <div class="modal fade" id="editUserModal">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <form method="POST" action="update_user.php">

                            <div class="modal-header">

                                <h5 class="modal-title">
                                    Edit User
                                </h5>

                                <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal">
                                </button>

                            </div>

                            <div class="modal-body">

                                <input type="hidden"
                                    name="user_id"
                                    id="edit_user_id">

                                <label>User Name</label>

                                <input type="text"
                                    name="user_name"
                                    id="edit_user_name"
                                    class="form-control">

                                <br>

                                <label>Email</label>

                                <input type="email"
                                    name="email"
                                    id="edit_user_email"
                                    class="form-control">

                            </div>

                            <div class="modal-footer">

                                <button type="submit"
                                    class="btn btn-success">

                                    Update User

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

            <!-- Pagination Buttons -->

            <div class="mt-3 text-center">

                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>

                    <a href="users.php?page=<?php echo $i; ?>"
                        class="btn btn-secondary btn-sm">

                        <?php echo $i; ?>

                    </a>

                <?php } ?>

            </div>

        </div>
    </div>
</div>
</div>
<script>
    var editModal =
        document.getElementById('editUserModal');

    editModal.addEventListener('show.bs.modal', function(event) {

        var button = event.relatedTarget;

        document.getElementById('edit_user_id').value =
            button.getAttribute('data-id');

        document.getElementById('edit_user_name').value =
            button.getAttribute('data-name');

        document.getElementById('edit_user_email').value =
            button.getAttribute('data-email');

    });
>>>>>>> 97ae37d326f91906b26df36d5ac5abd2494e3b0e
</script>