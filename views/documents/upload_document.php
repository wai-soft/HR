<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Document</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="form-container">
            <h1>Upload Document</h1>
            <form action="/controllers/DocumentController.php?action=upload" method="post" enctype="multipart/form-data">
                <label for="employee_id">Employee:</label>
                <select id="employee_id" name="employee_id" required>
                    <?php
                    include '../../config/db_connection.php';
                    $query = "SELECT id, name FROM employees";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                    } else {
                        echo "<option value=''>No employees found</option>";
                    }
                    ?>
                </select><br><br>
                <label for="document_name">Document Name:</label>
                <input type="text" id="document_name" name="document_name" required><br><br>
                                <label for="document">Document:</label>
                <input type="file" id="document" name="document" required><br><br>
                <input type="submit" value="Upload Document">
            </form>
        </div>
    </div>
</body>
</html>
