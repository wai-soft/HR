<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Salaries List</title>
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
            <h1>Salaries List</h1>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Employee ID</th>
                    <th>Basic Salary</th>
                    <th>Allowances</th>
                    <th>Deductions</th>
                    <th>Net Salary</th>
                    <th>Payment Date</th>
                    <th>Actions</th>
                </tr>
                <?php
                include '../../config/db_connection.php';
                include '../../models/Salary.php';

                $salary = new Salary($conn);
                $result = $salary->read();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['employee_id']}</td>
                                <td>{$row['basic_salary']}</td>
                                <td>{$row['allowances']}</td>
                                <td>{$row['deductions']}</td>
                                <td>{$row['net_salary']}</td>
                                <td>{$row['payment_date']}</td>
                                <td>
                                    <a href='/views/salaries/edit_salary.php?id={$row['id']}'>Edit</a> |
                                    <a href='/controllers/SalaryController.php?action=delete&id={$row['id']}'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No salaries found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>