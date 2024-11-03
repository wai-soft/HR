<?php
include '../config/db_connection.php';

if ($_GET['action'] == 'edit' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $assigned_to = $_POST['assigned_to'];
    $assignment_date = $_POST['assignment_date'];
    $return_date = $_POST['return_date'];

    $sql = "UPDATE assets SET name='$name', description='$description', assigned_to='$assigned_to', assignment_date='$assignment_date', return_date='$return_date' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Asset updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>