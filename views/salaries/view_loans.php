<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Loans List</title>
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
            <h1>Loans List</h1>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Employee ID</th>
                    <th>Amount</th>
                    <th>Issue Date</th>
                    <th>Repayment Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php
                include '../../config/db_connection.php';
                include '../../models/Loan.php';

                $loan = new Loan($conn);
                $result = $loan->read();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['employee_id']}</td>
                                <td>{$row['amount']}</td>
                                <td>{$row['issue_date']}</td>
                                <td>{$row['repayment_date']}</td>
                                <td>{$row['status']}</td>
                                <td>
                                    <a href='/views/salaries/edit_loan.php?id={$row['id']}'>Edit</a> |
                                    <a href='/controllers/LoanController.php?action=delete&id={$row['id']}'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No loans found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
