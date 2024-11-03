<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Sessions</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="card">
            <h1>Manage Sessions</h1>
            <table class="table">
                <tr>
                    <th>Session ID</th>
                    <th>User</th>
                    <th>IP Address</th>
                    <th>Last Activity</th>
                    <th>Actions</th>
                </tr>
                <?php
                include '../../config/db_connection.php';
                include '../../models/Session.php';

                $session = new Session($conn);
                $result = $session->read();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['session_id']}</td>
                                <td>{$row['user_id']}</td>
                                <td>{$row['ip_address']}</td>
                                <td>{$row['last_activity']}</td>
                                                                <td>
                                    <a href='/controllers/SessionController.php?action=logout&session_id={$row['session_id']}'>Logout</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No active sessions found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
