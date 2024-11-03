<?php
include '../config/db_connection.php';
include '../models/Loan.php';

$action = $_GET['action'];

if ($action == 'add' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $loan = new Loan($conn);
    $loan->employee_id = $_POST['employee_id'];
    $loan->amount = $_POST['amount'];
    $loan->issue_date = $_POST['issue_date'];
    $loan->repayment_date = $_POST['repayment_date'];
    $loan->status = 'pending';

    if ($loan->create()) {
        echo "<script>alert('Loan added successfully'); window.location.href='/views/loans/view_loans.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/loans/add_loan.php';</script>";
    }
}

if ($action == 'edit' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $loan = new Loan($conn);
    $loan->id = $_POST['id'];
    $loan->employee_id = $_POST['employee_id'];
    $loan->amount = $_POST['amount'];
    $loan->issue_date = $_POST['issue_date'];
    $loan->repayment_date = $_POST['repayment_date'];
    $loan->status = $_POST['status'];

    if ($loan->update()) {
        echo "<script>alert('Loan updated successfully'); window.location.href='/views/loans/view_loans.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/loans/edit_loan.php?id=" . $_POST['id'] . "';</script>";
    }
}

if ($action == 'delete' && isset($_GET['id'])) {
    $loan = new Loan($conn);
    $loan->id = $_GET['id'];

    if ($loan->delete()) {
        echo "<script>alert('Loan deleted successfully'); window.location.href='/views/loans/view_loans.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/loans/view_loans.php';</script>";
    }
}
?>
