<?php
include '../config/db_connection.php';
include '../models/Document.php';
include '../models/Notification.php';

$action = $_GET['action'];

if ($action == 'upload' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $document = new Document($conn);
    $document->employee_id = $_POST['employee_id'];
    $document->document_name = $_POST['document_name'];
    $document->upload_date = date('Y-m-d');

    if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["document"]["name"]);
        if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
            $document->document_path = $target_file;
        } else {
            echo "<script>alert('Error uploading document'); window.location.href='/views/documents/upload_document.php';</script>";
            exit();
        }
    }

    if ($document->create()) {
        $notification = new Notification($conn);
        $notification->employee_id = $document->employee_id;
        $notification->message = "New document uploaded: " . $document->document_name;
        $notification->status = 'unread';
        $notification->create();

        echo "<script>alert('Document uploaded successfully'); window.location.href='/views/documents/view_documents.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/documents/upload_document.php';</script>";
    }
}

if ($action == 'delete' && isset($_GET['id'])) {
    $document = new Document($conn);
    $document->id = $_GET['id'];

    if ($document->delete()) {
        echo "<script>alert('Document deleted successfully'); window.location.href='/views/documents/view_documents.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='/views/documents/view_documents.php';</script>";
    }
}
?>
