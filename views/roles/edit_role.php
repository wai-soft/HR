<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Role</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="form-container">
            <h1>Edit Role</h1>
            <?php
            include '../../config/db_connection.php';
            include '../../models/Role.php';
            include '../../models/Permission.php';
            include '../../models/RolePermission.php';

            $role = new Role($conn);
            $role->id = $_GET['id'];
            $result = $role->read_single();

            if ($result) {
                $row = $result->fetch_assoc();
            ?>
            <form action="/controllers/RoleController.php?action=edit" method="post">
                <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>">
                <label for="name">Role Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br><br>
                
                <label for="permissions">Permissions:</label><br>
                <?php
                $permission = new Permission($conn);
                $permissions = $permission->read();
                $rolePermission = new RolePermission($conn);
                $rolePermission->role_id = $row['id'];
                $rolePermissions = $rolePermission->read();
                $assignedPermissions = [];
                while ($rp = $rolePermissions->fetch_assoc()) {
                    $assignedPermissions[] = $rp['permission_id'];
                }
                if ($permissions->num_rows > 0) {
                    while($perm = $permissions->fetch_assoc()) {
                        $checked = in_array($perm['id'], $assignedPermissions) ? 'checked' : '';
                        echo "<input type='checkbox' name='permissions[]' value='{$perm['id']}' $checked> {$perm['name']}<br>";
                    }
                } else {
                    echo "No permissions found";
                }
                ?><br>
                <input type="submit" value="Update Role">
            </form>
            <?php
            } else {
                echo "Role not found.";
            }
            ?>
        </div>
    </div>
</body>
</html>
