<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Leaves List</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <div class="container">
        <div class="card">
            <h1>Leaves List</h1>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Employee ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reason</th>
                    <th>Actions</th>
                </tr>
                <?php
                include '../../config/db_connection.php';
                include '../../models/Leave.php';

                $leave = new Leave($conn);
                $result = $leave->read();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['employee_id']}</td>
                                <td>{$row['start_date']}</td>
                                <td>{$row['end_date']}</td>
                                <td>{$row['reason']}</td>
                                <td>
                                    <a href='/views/leaves/edit_leave.php?id={$row['id']}'>Edit</a> |
                                    <a href='/controllers/LeaveController.php?action=delete&id={$row['id']}'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No leaves found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
