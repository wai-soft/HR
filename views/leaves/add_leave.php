<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Leave</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <div class="form-container">
        <h1>Add New Leave</h1>
        <form action="/controllers/LeaveController.php?action=add" method="post">
            <label for="employee_id">Employee ID:</label>
            <input type="number" id="employee_id" name="employee_id" required><br><br>
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required><br><br>
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required><br><br>
            <label for="reason">Reason:</label>
            <textarea id="reason" name="reason" required></textarea><br><br>
            <input type="submit" value="Add Leave">
        </form>
    </div>
</body>
</html>
