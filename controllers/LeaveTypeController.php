<?php
include '../config/db_connection.php';
include '../models/LeaveType.php';

$action = $_GET['action'];

if ($action == 'add' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $leaveType = new LeaveType($conn);
    $leaveType->name = $_POST['name'];
    $leaveType->description = $_POST['description'];

    if ($leaveType->create()) {
        echo "<script>alert('Leave type added successfully'); window.location.href='/views/leaves/view_leave_types.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/leaves/add_leave_type.php';</script>";
    }
}
?>
