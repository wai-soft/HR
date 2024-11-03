<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Loan</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="form-container">
            <h1>Edit Loan</h1>
            <?php
            include '../../config/db_connection.php';
            include '../../models/Loan.php';

            $loan = new Loan($conn);
            $loan->id = $_GET['id'];
            $result = $loan->read_single();

            if ($result) {
                $row = $result->fetch_assoc();
            ?>
            <form action="/controllers/LoanController.php?action=edit" method="post">
                <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>">
                <label for="employee_id">Employee ID:</label>
                <input type="number" id="employee_id" name="employee_id" value="<?php echo $row['employee_id']; ?>" required><br><br>
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" value="<?php echo $row['amount']; ?>" step="0.01" required><br><br>
                <label for="issue_date">Issue Date:</label>
                <input type="date" id="issue_date" name="issue_date" value="<?php echo $row['issue_date']; ?>" required><br><br>
                <label for="repayment_date">Repayment Date:</label>
                <input type="date" id="repayment_date" name="repayment_date" value="<?php echo $row['repayment_date']; ?>" required><br><br>
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="pending" <?php if ($row['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                    <option value="paid" <?php if ($row['status'] == 'paid') echo 'selected'; ?>>Paid</option>
                </select><br><br>
                <input type="submit" value="Update Loan">
            </form>
            <?php
            } else {
                echo "Loan not found.";
            }
            ?>
        </div>
    </div>
</body>
</html>
