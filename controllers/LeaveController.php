<?php
include '../config/db_connection.php';
include '../models/Leave.php';

$action = $_GET['action'];

if ($action == 'request' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $leave = new Leave($conn);
    $leave->employee_id = $_POST['employee_id'];
    $leave->start_date = $_POST['start_date'];
    $leave->end_date = $_POST['end_date'];
    $leave->reason = $_POST['reason'];

    if ($leave->create()) {
        echo "<script>alert('Leave request submitted successfully'); window.location.href='/views/leaves/view_leaves.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/leaves/request_leave.php';</script>";
    }
}

if ($action == 'approve' && isset($_GET['id'])) {
    $leave = new Leave($conn);
    $leave->id = $_GET['id'];
    $leave->status = 'approved';

    if ($leave->update_status()) {
        echo "<script>alert('Leave approved successfully'); window.location.href='/views/leaves/approve_leave.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/leaves/approve_leave.php';</script>";
    }
}

if ($action == 'reject' && isset($_GET['id'])) {
    $leave = new Leave($conn);
    $leave->id = $_GET['id'];
    $leave->status = 'rejected';

    if ($leave->update_status()) {
        echo "<script>alert('Leave rejected successfully'); window.location.href='/views/leaves/approve_leave.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/leaves/approve_leave.php';</script>";
    }
}

if ($action == 'report' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $leave = new Leave($conn);
    $leave->employee_id = $_POST['employee_id'];
    $leave->start_date = $_POST['start_date'];
    $leave->end_date = $_POST['end_date'];

    $result = $leave->generate_report();

    if ($result->num_rows > 0) {
        echo "<h1>Leave Report</h1>";
        echo "<table class='table'>";
        echo "<tr><th>ID</th><th>Employee</th><th>Start Date</th><th>End Date</th><th>Reason</th><th>Status</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['employee_id']}</td>
                    <td>{$row['start_date']}</td>
                    <td>{$row['end_date']}</td>
                    <td>{$row['reason']}</td>
                    <td>{$row['status']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<script>alert('No leave records found for the selected period'); window.location.href='/views/leaves/leave_report.php';</script>";
    }
}
?>
