<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>HRM Dashboard</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
    <script src="/public/scripts.js"></script>
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="card">
            <h1>Welcome to the HRM System</h1>
            <div class="stats">
                <p>Total Employees: <?php echo $employee_count; ?></p>
                <p>Total Companies: <?php echo $company_count; ?></p>
                <p>Attendance Today: <?php echo $attendance_today; ?></p>
                <p>Total Salaries This Month: <?php echo $salary_total; ?></p>
                <p>Total Assets: <?php echo $assets_count; ?></p>
            </div>
        </div>
        <div class="card">
            <h2>Dashboard Statistics</h2>
            <img src="/path/to/dashboard_statistics.png" alt="Dashboard Statistics">
        </div>
        <div class="card">
            <h2>Attendance Today</h2>
            <img src="/path/to/attendance_pie_chart.png" alt="Attendance Today">
        </div>
        <div class="card">
            <h2>Salaries Over Time</h2>
            <img src="/path/to/salaries_line_chart.png" alt="Salaries Over Time">
        </div>
    </div>
</body>
</html>
