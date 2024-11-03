<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /views/auth/login.php");
    exit();
}

include '../config/db_connection.php';

$employee_count = $conn->query("SELECT COUNT(*) AS count FROM employees")->fetch_assoc()['count'];
$company_count = $conn->query("SELECT COUNT(*) AS count FROM companies")->fetch_assoc()['count'];
$attendance_today = $conn->query("SELECT COUNT(*) AS count FROM attendance WHERE DATE(check_in) = CURDATE()")->fetch_assoc()['count'];
$salary_total = $conn->query("SELECT SUM(net_salary) AS total FROM salaries WHERE MONTH(payment_date) = MONTH(CURDATE())")->fetch_assoc()['total'];
$assets_count = $conn->query("SELECT COUNT(*) AS count FROM assets")->fetch_assoc()['count'];
?>
