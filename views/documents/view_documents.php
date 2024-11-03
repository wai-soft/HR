<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>View Documents</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="card">
            <h1>View Documents</h1>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Employee</th>
                    <th>Document Name</th>
                    <th>Upload Date</th>
                    <th>Actions</th>
                </tr>
                <?php
                include '../../config/db_connection.php';
                include '../../models/Document.php';

                $document = new Document($conn);
                $result = $document->read();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['employee_id']}</td>
                                <td>{$row['document_name']}</td>
                                <td>{$row['upload_date']}</td>
                                <td>
                                    <a href='{$row['document_path']}' target='_blank'>View</a> |
                                    <a href='/controllers/DocumentController.php?action=delete&id={$row['id']}'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No documents found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
