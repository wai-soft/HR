<?php
include '../config/db_connection.php';
include '../models/Attendance.php';

$action = $_GET['action'];

if ($action == 'record' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $attendance = new Attendance($conn);
    $attendance->employee_id = $_POST['employee_id'];
    $attendance->check_in = $_POST['check_in'];
    $attendance->check_out = $_POST['check_out'];

    if ($attendance->create()) {
        echo "<script>alert('Attendance recorded successfully'); window.location.href='/views/attendance/view_attendance.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/attendance/attendance.php';</script>";
    }
}

if ($action == 'report' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $attendance = new Attendance($conn);
    $attendance->employee_id = $_POST['employee_id'];
    $attendance->start_date = $_POST['start_date'];
    $attendance->end_date = $_POST['end_date'];

    $result = $attendance->generate_report();

    if ($result->num_rows > 0) {
        echo "<h1>Attendance Report</h1>";
        echo "<table class='table'>";
        echo "<tr><th>ID</th><th>Employee</th><th>Check In</th><th>Check Out</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['employee_id']}</td>
                    <td>{$row['check_in']}</td>
                    <td>{$row['check_out']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<script>alert('No attendance records found for the selected period'); window.location.href='/views/attendance/attendance_report.php';</script>";
    }
}
?>
