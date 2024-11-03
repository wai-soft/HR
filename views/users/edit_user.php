<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
    <script src="/public/scripts.js"></script>
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="form-container">
            <h1>Edit User</h1>
            <?php
            include '../../config/db_connection.php';
            include '../../models/User.php';

            $user = new User($conn);
            $user->id = $_GET['id'];
            $result = $user->read_single();

            if ($result) {
                $row = $result->fetch_assoc();
            ?>
            <form action="/controllers/UserController.php?action=edit" method="post">
                <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password"><br><br>
                <label for="role_id">Role:</label>
                <select id="role_id" name="role_id" required>
                    <?php
                    $query = "SELECT id, name FROM roles";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while($role = $result->fetch_assoc()) {
                            $selected = ($role['id'] == $row['role_id']) ? 'selected' : '';
                            echo "<option value='{$role['id']}' $selected>{$role['name']}</option>";
                        }
                    } else {
                        echo "<option value=''>No roles found</option>";
                    }
                    ?>
                </select><br><br>
                <input type="submit" value="Update User">
            </form>
            <?php
            } else {
                echo "User not found.";
            }
            ?>
        </div>
    </div>
</body>
</html>
