<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Salary Details</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
    <script>
        function toggleSubmenu(id) {
            var submenu = document.getElementById(id);
            if (submenu.style.display === "block") {
                submenu.style.display = "none";
            } else {
                submenu.style.display = "block";
            }
        }
    </script>
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="card">
            <h1>Salary Details</h1>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Salary ID</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
                <?php
                include '../../config/db_connection.php';
                include '../../models/SalaryDetails.php';

                $salaryDetails = new SalaryDetails($conn);
                $result = $salaryDetails->read();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['salary_id']}</td>
                                <td>{$row['description']}</td>
                                <td>{$row['amount']}</td>
                                <td>{$row['type']}</td>
                                <td>
                                    <a href='/views/salaries/edit_salary_detail.php?id={$row['id']}'>Edit</a> |
                                    <a href='/controllers/SalaryDetailsController.php?action=delete&id={$row['id']}'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No salary details found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
