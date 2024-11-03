<?php
include '../config/db_connection.php';
include '../models/Company.php';

$action = $_GET['action'];

if ($action == 'add' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $company = new Company($conn);
    $company->name = $_POST['name'];
    $company->address = $_POST['address'];

    if ($company->create()) {
        echo "Company added successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}

if ($action == 'edit' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $company = new Company($conn);
    $company->id = $_POST['id'];
    $company->name = $_POST['name'];
    $company->address = $_POST['address'];

    if ($company->update()) {
        echo "Company updated successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}

if ($action == 'delete' && isset($_GET['id'])) {
    $company = new Company($conn);
    $company->id = $_GET['id'];

    if ($company->delete()) {
        echo "Company deleted successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
