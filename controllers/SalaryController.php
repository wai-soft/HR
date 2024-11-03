<?php
include '../config/session_check.php';
include '../config/db_connection.php';
include '../models/Salary.php';
include '../models/SalaryDetails.php';

$action = $_GET['action'];

if ($action == 'add' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $salary = new Salary($conn);
    $salary->employee_id = $_POST['employee_id'];
    $salary->basic_salary = $_POST['basic_salary'];
    $salary->allowances = $_POST['allowances'];
    $salary->deductions = $_POST['deductions'];
    $salary->net_salary = $salary->basic_salary + $salary->allowances - $salary->deductions;
    $salary->payment_date = $_POST['payment_date'];

    if ($salary->create()) {
        $salary_id = $conn->insert_id;

        if (isset($_POST['details'])) {
            $details = $_POST['details'];
            foreach ($details as $detail) {
                $salaryDetail = new SalaryDetails($conn);
                $salaryDetail->salary_id = $salary_id;
                $salaryDetail->description = $detail['description'];
                $salaryDetail->amount = $detail['amount'];
                $salaryDetail->type = $detail['type'];
                $salaryDetail->create();
            }
        }

        echo "<script>alert('Salary added successfully'); window.location.href='/views/salaries/view_salaries.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/salaries/add_salary.php';</script>";
    }
}

if ($action == 'edit' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $salary = new Salary($conn);
    $salary->id = $_POST['id'];
    $salary->employee_id = $_POST['employee_id'];
    $salary->basic_salary = $_POST['basic_salary'];
    $salary->allowances = $_POST['allowances'];
    $salary->deductions = $_POST['deductions'];
    $salary->net_salary = $salary->basic_salary + $salary->allowances - $salary->deductions;
    $salary->payment_date = $_POST['payment_date'];

    if ($salary->update()) {
        if (isset($_POST['details'])) {
            $details = $_POST['details'];
            foreach ($details as $detail) {
                $salaryDetail = new SalaryDetails($conn);
                $salaryDetail->id = $detail['id'];
                $salaryDetail->salary_id = $salary->id;
                $salaryDetail->description = $detail['description'];
                $salaryDetail->amount = $detail['amount'];
                $salaryDetail->type = $detail['type'];
                $salaryDetail->update();
            }
        }

        echo "<script>alert('Salary updated successfully'); window.location.href='/views/salaries/view_salaries.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/salaries/edit_salary.php?id=" . $_POST['id'] . "';</script>";
    }
}

if ($action == 'delete' && isset($_GET['id'])) {
    $salary = new Salary($conn);
    $salary->id = $_GET['id'];

    if ($salary->delete()) {
        echo "<script>alert('Salary deleted successfully'); window.location.href='/views/salaries/view_salaries.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/salaries/view_salaries.php';</script>";
    }
}

if ($action == 'report' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $salary = new Salary($conn);
    $salary->employee_id = $_POST['employee_id'];
    $salary->start_date = $_POST['start_date'];
    $salary->end_date = $_POST['end_date'];

    $result = $salary->generate_report();

    if ($result->num_rows > 0) {
        echo "<h1>Salary Report</h1>";
        echo "<table class='table'>";
        echo "<tr><th>ID</th><th>Employee</th><th>Basic Salary</th><th>Allowances</th><th>Deductions</th><th>Net Salary</th><th>Payment Date</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['employee_id']}</td>
                    <td>{$row['basic_salary']}</td>
                    <td>{$row['allowances']}</td>
                    <td>{$row['deductions']}</td>
                    <td>{$row['net_salary']}</td>
                    <td>{$row['payment_date']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<script>alert('No salary records found for the selected period'); window.location.href='/views/salaries/salary_report.php';</script>";
    }
}
?>
