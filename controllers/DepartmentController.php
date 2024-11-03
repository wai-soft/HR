<?php
include '../config/db_connection.php';
include '../models/Department.php';

$action = $_GET['action'];

if ($action == 'add' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $department = new Department($conn);
    $department->name = $_POST['name'];
    $department->description = $_POST['description'];

    if ($department->create()) {
        echo "<script>alert('Department added successfully'); window.location.href='/views/departments/view_departments.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/departments/add_department.php';</script>";
    }
}

if ($action == 'edit' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $department = new Department($conn);
    $department->id = $_POST['id'];
    $department->name = $_POST['name'];
    $department->description = $_POST['description'];

    if ($department->update()) {
        echo "<script>alert('Department updated successfully'); window.location.href='/views/departments/view_departments.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/departments/edit_department.php?id=" . $_POST['id'] . "';</script>";
    }
}

if ($action == 'delete' && isset($_GET['id'])) {
    $department = new Department($conn);
    $department->id = $_GET['id'];

    if ($department->delete()) {
        echo "<script>alert('Department deleted successfully'); window.location.href='/views/departments/view_departments.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/departments/view_departments.php';</script>";
    }
}

if ($action == 'assign' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['employee_id'];
    $department_id = $_POST['department_id'];

    $query = "UPDATE employees SET department_id = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $department_id, $employee_id);

    if ($stmt->execute()) {
        echo "<script>alert('Employee assigned to department successfully'); window.location.href='/views/departments/view_departments.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/departments/assign_department.php';</script>";
    }
}

if ($action == 'report' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $department = new Department($conn);
    $department->id = $_POST['department_id'];
    $department->start_date = $_POST['start_date'];
    $department->end_date = $_POST['end_date'];

    $result = $department->generate_report();

    if ($result->num_rows > 0) {
        echo "<h1>Department Report</h1>";
        echo "<table class='table'>";
        echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Start Date</th><th>End Date</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['start_date']}</td>
                    <td>{$row['end_date']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<script>alert('No department records found for the selected period'); window.location.href='/views/departments/department_report.php';</script>";
    }
}
?>
