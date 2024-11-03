<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Approve Leave</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
    <script src="/public/scripts.js"></script>
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="card">
            <h1>Approve Leave</h1>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Employee</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php
                include '../../config/db_connection.php';
                include '../../models/Leave.php';

                $leave = new Leave($conn);
                $result = $leave->read_pending();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['employee_id']}</td>
                                <td>{$row['start_date']}</td>
                                <td>{$row['end_date']}</td>
                                <td>{$row['reason']}</td>
                                <td>{$row['status']}</td>
                                <td>
                                    <a href='/controllers/LeaveController.php?action=approve&id={$row['id']}'>Approve</a> |
                                    <a href='/controllers/LeaveController.php?action=reject&id={$row['id']}'>Reject</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No pending leave requests</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
