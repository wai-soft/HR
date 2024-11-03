<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Salary</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
    <script>
        function addDetail() {
            var detailsContainer = document.getElementById('detailsContainer');
            var detailDiv = document.createElement('div');
            detailDiv.className = 'detail';
            detailDiv.innerHTML = `
                <label for="description">Description:</label>
                <input type="text" name="details[][description]" required><br><br>
                <label for="amount">Amount:</label>
                <input type="number" name="details[][amount]" step="0.01" required><br><br>
                <label for="type">Type:</label>
                <select name="details[][type]" required>
                    <option value="allowance">Allowance</option>
                    <option value="deduction">Deduction</option>
                </select><br><br>
            `;
            detailsContainer.appendChild(detailDiv);
        }
    </script>
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="form-container">
            <h1>Add New Salary</h1>
            <form action="/controllers/SalaryController.php?action=add" method="post">
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
                <label for="basic_salary">Basic Salary:</label>
                <input type="number" id="basic_salary" name="basic_salary" step="0.01" required><br><br>
                <label for="allowances">Allowances:</label>
                <input type="number" id="allowances" name="allowances" step="0.01" required><br><br>
                <label for="deductions">Deductions:</label>
                <input type="number" id="deductions" name="deductions" step="0.01" required><br><br>
                <label for="payment_date">Payment Date:</label>
                <input type="date" id="payment_date" name="payment_date" required><br><br>
                <div id="detailsContainer"></div>
                <button type="button" onclick="addDetail()">Add Detail</button><br><br>
                <input type="submit" value="Add Salary">
            </form>
        </div>
    </div>
</body>
</html>
