<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Department</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
    <script src="/public/scripts.js"></script>
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="form-container">
            <h1>Add New Department</h1>
            <form action="/controllers/DepartmentController.php?action=add" method="post">
                <label for="name">Department Name:</label>
                <input type="text" id="name" name="name" required><br><br>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea><br><br>
                <input type="submit" value="Add Department">
            </form>
        </div>
    </div>
</body>
</html>
