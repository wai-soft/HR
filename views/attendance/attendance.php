<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Attendance</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
    <script src="/public/scripts.js"></script>
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="form-container">
            <h1>Record Attendance</h1>
            <form action="/controllers/AttendanceController.php?action=record" method="post">
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
                <label for="check_in">Check In:</label>
                <input type="datetime-local" id="check_in" name="check_in" required><br><br>
                <label for="check_out">Check Out:</label>
                <input type="datetime-local" id="check_out" name="check_out"><br><br>
                <input type="submit" value="Record Attendance">
            </form>
        </div>
    </div>
</body>
</html>
