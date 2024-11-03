<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Role</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="form-container">
            <h1>Add New Role</h1>
            <form action="/controllers/RoleController.php?action=add" method="post">
                <label for="name">Role Name:</label>
                <input type="text" id="name" name="name" required><br><br>
                
                <label for="permissions">Permissions:</label><br>
                <?php
                include '../../config/db_connection.php';
                include '../../models/Permission.php';

                $permission = new Permission($conn);
                $permissions = $permission->read();
                if ($permissions->num_rows > 0) {
                    while($perm = $permissions->fetch_assoc()) {
                        echo "<input type='checkbox' name='permissions[]' value='{$perm['id']}'> {$perm['name']}<br>";
                    }
                } else {
                    echo "No permissions found";
                }
                ?><br>
                <input type="submit" value="Add Role">
            </form>
        </div>
    </div>
</body>
</html>
