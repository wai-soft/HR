<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Department Report</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
    <script src="/public/scripts.js"></script>
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="card">
            <h1>Department Report</h1>
            <form action="/controllers/DepartmentController.php?action=report" method="post">
                <label for="department_id">Department:</label>
                <select id="department_id" name="department_id" required>
                    <?php
                    include '../../config/db_connection.php';
                    $query = "SELECT id, name FROM departments";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                    } else {
                        echo "<option value=''>No departments found</option>";
                    }
                    ?>
                </select><br><br>
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required><br><br>
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required><br><br>
                <input type="submit" value="Generate Report">
            </form>
        </div>
    </div>
</body>
</html>
