<?php
session_start();
include '../config/db_connection.php';
include '../models/User.php';

if ($_GET['action'] == 'login' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User($conn);
    $user->username = $_POST['username'];
    $enteredPassword = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        error_log("Error preparing statement: " . $conn->error, 3, '/path/to/your/log/file.log');
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/auth/login.php';</script>";
        exit();
    }
    $stmt->bind_param("s", $user->username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedHashedPassword = $row['password'];

        if (password_verify($enteredPassword, $storedHashedPassword)) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role_id'] = $row['role_id'];
            header("Location: /views/dashboard/index.php");
            exit();
        } else {
            echo "<script>alert('Invalid username or password.'); window.location.href='/views/auth/login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Invalid username or password.'); window.location.href='/views/auth/login.php';</script>";
        exit();
    }
}

if ($_GET['action'] == 'logout') {
    session_destroy();
    header("Location: /views/auth/login.php");
    exit();
}
?>
