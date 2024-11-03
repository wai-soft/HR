<?php
include '../config/db_connection.php';
include '../models/SalaryDetails.php';

$action = $_GET['action'];

if ($action == 'delete' && isset($_GET['id'])) {
    $salaryDetail = new SalaryDetails($conn);
    $salaryDetail->id = $_GET['id'];

    if ($salaryDetail->delete()) {
        echo "Salary detail deleted successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
