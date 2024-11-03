<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
    <script src="/public/scripts.js"></script>
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="card">
            <h1>Attendance Report</h1>
            <form action="/controllers/AttendanceController.php?action=report" method="post">
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
