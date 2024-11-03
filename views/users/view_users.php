<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="card">
            <h1>Users List</h1>
            <?php
            include '../../config/db_connection.php';
            include '../../models/User.php';

            session_start();
            $user = new User($conn);
            $user->id = $_SESSION['user_id'];

            if ($user->has_permission('manage_users')) {
            ?>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                <?php
                $result = $user->read();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['role']}</td>
                                <td>
                                    <a href='/views/users/edit_user.php?id={$row['id']}'>Edit</a> |
                                    <a href='/controllers/UserController.php?action=delete&id={$row['id']}'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found</td></tr>";
                }
                ?>
            </table>
            <?php
            } else {
                echo "<p>You do not have permission to view this page.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
