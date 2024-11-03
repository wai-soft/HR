<?php
include '../config/db_connection.php';
include '../models/Permission.php';

function log_error($message) {
    error_log($message, 3, '../log/file.log');
}

$action = $_GET['action'];

if ($action == 'add' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $permission = new Permission($conn);
    $permission->name = $_POST['name'];
    $permission->description = $_POST['description'];

    if ($permission->create()) {
        echo "<script>alert('Permission added successfully'); window.location.href='/views/permissions/view_permissions.php';</script>";
    } else {
        log_error("Error creating permission: " . $conn->error . " | Data: " . json_encode($_POST));
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/permissions/add_permission.php';</script>";
    }
}

if ($action == 'edit' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $permission = new Permission($conn);
    $permission->id = $_POST['id'];
    $permission->name = $_POST['name'];
    $permission->description = $_POST['description'];

    if ($permission->update()) {
        echo "<script>alert('Permission updated successfully'); window.location.href='/views/permissions/view_permissions.php';</script>";
    } else {
        log_error("Error updating permission: " . $conn->error . " | Data: " . json_encode($_POST));
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/permissions/edit_permission.php?id=" . $_POST['id'] . "';</script>";
    }
}

if ($action == 'delete' && isset($_GET['id'])) {
    $permission = new Permission($conn);
    $permission->id = $_GET['id'];

    if ($permission->delete()) {
        echo "<script>alert('Permission deleted successfully'); window.location.href='/views/permissions/view_permissions.php';</script>";
    } else {
        log_error("Error deleting permission: " . $conn->error . " | Permission ID: " . $permission->id);
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/permissions/view_permissions.php';</script>";
    }
}
?>
