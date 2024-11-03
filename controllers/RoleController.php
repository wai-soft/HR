<?php
include '../config/db_connection.php';
include '../models/Role.php';
include '../models/RolePermission.php';

$action = $_GET['action'];

if ($action == 'add' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $role = new Role($conn);
    $role->name = $_POST['name'];

    if ($role->create()) {
        $role_id = $conn->insert_id;
        $rolePermission = new RolePermission($conn);
        $rolePermission->role_id = $role_id;

        if (isset($_POST['permissions'])) {
            foreach ($_POST['permissions'] as $permission_id) {
                $rolePermission->permission_id = $permission_id;
                $rolePermission->create();
            }
        }

        echo "<script>alert('Role added successfully'); window.location.href='/views/roles/view_roles.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/roles/add_role.php';</script>";
    }
}

if ($action == 'edit' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $role = new Role($conn);
    $role->id = $_POST['id'];
    $role->name = $_POST['name'];

    if ($role->update()) {
        $rolePermission = new RolePermission($conn);
        $rolePermission->role_id = $role->id;
        $rolePermission->delete_all();

        if (isset($_POST['permissions'])) {
            foreach ($_POST['permissions'] as $permission_id) {
                $rolePermission->permission_id = $permission_id;
                $rolePermission->create();
            }
        }

        echo "<script>alert('Role updated successfully'); window.location.href='/views/roles/view_roles.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/roles/edit_role.php?id=" . $_POST['id'] . "';</script>";
    }
}

if ($action == 'delete' && isset($_GET['id'])) {
    $role = new Role($conn);
    $role->id = $_GET['id'];

    if ($role->delete()) {
        echo "<script>alert('Role deleted successfully'); window.location.href='/views/roles/view_roles.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/roles/view_roles.php';</script>";
    }
}
?>
