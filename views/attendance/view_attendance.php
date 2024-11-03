<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Attendance Records</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
    <script src="/public/scripts.js"></script>
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="card">
            <h1>Attendance Records</h1>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Employee</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Actions</th>
                </tr>
                <?php
                include '../../config/db_connection.php';
                include '../../models/Attendance.php';

                $attendance = new Attendance($conn);
                $result = $attendance->read();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['employee_id']}</td>
                                <td>{$row['check_in']}</td>
                                <td>{$row['check_out']}</td>
                                <td>
                                    <a href='/views/attendance/edit_attendance.php?id={$row['id']}'>Edit</a> |
                                    <a href='/controllers/AttendanceController.php?action=delete&id={$row['id']}'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No attendance records found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
