<?php
include '../config/db_connection.php';
include '../models/Notification.php';

$action = $_GET['action'];

if ($action == 'mark_as_read' && isset($_GET['id'])) {
    $notification = new Notification($conn);
    $notification->id = $_GET['id'];

    if ($notification->mark_as_read()) {
        echo "<script>alert('Notification marked as read'); window.location.href='/views/notifications/view_notifications.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/notifications/view_notifications.php';</script>";
    }
}
?>
