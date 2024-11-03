<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Salary</title>
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
            <h1>Edit Salary</h1>
            <?php
            include '../../config/db_connection.php';
            include '../../models/Salary.php';
            include '../../models/SalaryDetails.php';

            $salary = new Salary($conn);
            $salary->id = $_GET['id'];
            $result = $salary->read_single();

            if ($result) {
                $row = $result->fetch_assoc();
            ?>
            <form action="/controllers/SalaryController.php?action=edit" method="post">
                <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>">
                <label for="employee_id">Employee ID:</label>
                <input type="number" id="employee_id" name="employee_id" value="<?php echo $row['employee_id']; ?>" required><br><br>
                <label for="basic_salary">Basic Salary:</label>
                <input type="number" id="basic_salary" name="basic_salary" value="<?php echo $row['basic_salary']; ?>" step="0.01" required><br><br>
                <label for="allowances">Allowances:</label>
                <input type="number" id="allowances" name="allowances" value="<?php echo $row['allowances']; ?>" step="0.01" required><br><br>
                <label for="deductions">Deductions:</label>
                <input type="number" id="deductions" name="deductions" value="<?php echo $row['deductions']; ?>" step="0.01" required><br><br>
                <label for="payment_date">Payment Date:</label>
                <input type="date" id="payment_date" name="payment_date" value="<?php echo $row['payment_date']; ?>" required><br><br>
                <div id="detailsContainer">
                    <?php
                    $salaryDetails = new SalaryDetails($conn);
                    $salaryDetails->salary_id = $row['id'];
                    $detailsResult = $salaryDetails->read();
                    while ($detail = $detailsResult->fetch_assoc()) {
                        echo "
                        <div class='detail'>
                            <label for='description'>Description:</label>
                            <input type='text' name='details[][description]' value='{$detail['description']}' required><br><br>
                            <label for='amount'>Amount:</label>
                            <input type='number' name='details[][amount]' value='{$detail['amount']}' step='0.01' required><br><br>
                            <label for='type'>Type:</label>
                            <select name='details[][type]' required>
                                <option value='allowance' " . ($detail['type'] == 'allowance' ? 'selected' : '') . ">Allowance</option>
                                <option value='deduction' " . ($detail['type'] == 'deduction' ? 'selected' : '') . ">Deduction</option>
                            </select><br><br>
                        </div>";
                    }
                    ?>
                </div>
                <button type="button" onclick="addDetail()">Add Detail</button><br><br>
                <input type="submit" value="Update Salary">
            </form>
            <?php
            } else {
                echo "Salary not found.";
            }
            ?>
        </div>
    </div>
</body>
</html>
