<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
    <script src="/public/scripts.js"></script>
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="form-container">
            <h1>Add New User</h1>
            <form action="/controllers/UserController.php?action=add" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>
                <label for="role_id">Role:</label>
                <select id="role_id" name="role_id" required>
                    <?php
                    include '../../config/db_connection.php';
                    $query = "SELECT id, name FROM roles";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                    } else {
                        echo "<option value=''>No roles found</option>";
                    }
                    ?>
                </select><br><br>
                <input type="submit" value="Add User">
            </form>
        </div>
    </div>
</body>
</html>
