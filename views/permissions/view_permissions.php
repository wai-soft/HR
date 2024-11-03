<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Permissions List</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
    <script src="/public/scripts.js"></script>
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="card">
            <h1>Permissions List</h1>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
                <?php
                include '../../config/db_connection.php';
                include '../../models/Permission.php';

                $permission = new Permission($conn);
                $result = $permission->read();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['description']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No permissions found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
