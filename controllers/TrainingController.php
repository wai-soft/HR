<?php
include '../config/db_connection.php';
include '../models/TrainingSession.php';

$action = $_GET['action'];

if ($action == 'add' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $training = new TrainingSession($conn);
    $training->employee_id = $_POST['employee_id'];
    $training->course_name = $_POST['course_name'];
    $training->start_date = $_POST['start_date'];
    $training->end_date = $_POST['end_date'];
    $training->status = $_POST['status'];

    if ($training->create()) {
        echo "<script>alert('Training session added successfully'); window.location.href='/views/training/view_training.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/training/add_training.php';</script>";
    }
}

if ($action == 'report' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $training = new TrainingSession($conn);
    $training->employee_id = $_POST['employee_id'];
    $training->start_date = $_POST['start_date'];
    $training->end_date = $_POST['end_date'];

    $result = $training->generate_report();

    if ($result->num_rows > 0) {
        echo "<h1>Training Report</h1>";
        echo "<table class='table'>";
        echo "<tr><th>ID</th><th>Employee</th><th>Course Name</th><th>Start Date</th><th>End Date</th><th>Status</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['employee_id']}</td>
                    <td>{$row['course_name']}</td>
                    <td>{$row['start_date']}</td>
                    <td>{$row['end_date']}</td>
                    <td>{$row['status']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<script>alert('No training sessions found for the selected period'); window.location.href='/views/training/training_report.php';</script>";
    }
}
?>
