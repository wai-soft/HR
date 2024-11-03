<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Leave Types</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
    <script src="/public/scripts.js"></script>
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="card">
            <h1>Leave Types</h1>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                <?php
                include '../../config/db_connection.php';
                include '../../models/LeaveType.php';

                $leaveType = new LeaveType($conn);
                $result = $leaveType->read();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['description']}</td>
                                <td>
                                    <a href='/views/leaves/edit_leave_type.php?id={$row['id']}'>Edit</a> |
                                    <a href='/controllers/LeaveTypeController.php?action=delete&id={$row['id']}'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No leave types found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
