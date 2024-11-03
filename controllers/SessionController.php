<?php
include '../config/db_connection.php';
include '../models/Session.php';

$action = $_GET['action'];

if ($action == 'logout' && isset($_GET['session_id'])) {
    $session = new Session($conn);
    $session->session_id = $_GET['session_id'];

    if ($session->logout()) {
        echo "<script>alert('Session logged out successfully'); window.location.href='/views/sessions/manage_sessions.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/sessions/manage_sessions.php';</script>";
    }
}
?>
