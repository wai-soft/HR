<?php
include '../config/db_connection.php';
include '../models/Goal.php';

$action = $_GET['action'];

if ($action == 'add' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $goal = new Goal($conn);
    $goal->employee_id = $_POST['employee_id'];
    $goal->title = $_POST['title'];
    $goal->description = $_POST['description'];
    $goal->start_date = $_POST['start_date'];
    $goal->end_date = $_POST['end_date'];
    $goal->status = 'pending';

    if ($goal->create()) {
        echo "<script>alert('Goal added successfully'); window.location.href='/views/goals/view_goals.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/goals/add_goal.php';</script>";
    }
}

if ($action == 'edit' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $goal = new Goal($conn);
    $goal->id = $_POST['id'];
    $goal->employee_id = $_POST['employee_id'];
    $goal->title = $_POST['title'];
    $goal->description = $_POST['description'];
    $goal->start_date = $_POST['start_date'];
    $goal->end_date = $_POST['end_date'];
    $goal->status = $_POST['status'];

    if ($goal->update()) {
        echo "<script>alert('Goal updated successfully'); window.location.href='/views/goals/view_goals.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/goals/edit_goal.php?id=" . $_POST['id'] . "';</script>";
    }
}

if ($action == 'delete' && isset($_GET['id'])) {
    $goal = new Goal($conn);
    $goal->id = $_GET['id'];

    if ($goal->delete()) {
        echo "<script>alert('Goal deleted successfully'); window.location.href='/views/goals/view_goals.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/goals/view_goals.php';</script>";
    }
}
?>
