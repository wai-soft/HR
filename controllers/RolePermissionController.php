<?php
include '../config/db_connection.php';
include '../models/RolePermission.php';

$action = $_GET['action'];

if ($action == 'update' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $role_id = $_POST['role_id'];
    $permissions = $_POST['permissions'];

    $rolePermission = new RolePermission($conn);
    $rolePermission->role_id = $role_id;
    $rolePermission->delete_all();

    foreach ($permissions as $permission_id) {
        $rolePermission->permission_id = $permission_id;
        $rolePermission->create();
    }

    echo "<script>alert('Permissions updated successfully'); window.location.href='/views/permissions/manage_permissions.php';</script>";
}
?>
