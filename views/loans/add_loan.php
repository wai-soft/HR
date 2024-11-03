<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Loan</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="form-container">
            <h1>Add New Loan</h1>
            <form action="/controllers/LoanController.php?action=add" method="post">
                <label for="employee_id">Employee:</label>
                <select id="employee_id" name="employee_id" required>
                    <?php
                    include '../../config/db_connection.php';
                    $query = "SELECT id, name FROM employees";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                    } else {
                        echo "<option value=''>No employees found</option>";
                    }
                    ?>
                </select><br><br>
                <label for="amount">Loan Amount:</label>
                <input type="number" id="amount" name="amount" step="0.01" required><br><br>
                <label for="issue_date">Issue Date:</label>
                <input type="date" id="issue_date" name="issue_date" required><br><br>
                <label for="repayment_date">Repayment Date:</label>
                <input type="date" id="repayment_date" name="repayment_date" required><br><br>
                <input type="submit" value="Add Loan">
            </form>
        </div>
    </div>
</body>
</html>
