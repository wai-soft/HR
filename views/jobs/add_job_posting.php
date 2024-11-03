<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Job Posting</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="form-container">
            <h1>Add New Job Posting</h1>
            <form action="/controllers/JobController.php?action=add" method="post">
                <label for="title">Job Title:</label>
                <input type="text" id="title" name="title" required><br><br>
                <label for="description">Job Description:</label>
                <textarea id="description" name="description" required></textarea><br><br>
                <label for="requirements">Requirements:</label>
                <textarea id="requirements" name="requirements" required></textarea><br><br>
                <label for="posted_date">Posted Date:</label>
                <input type="date" id="posted_date" name="posted_date" required><br><br>
                <input type="submit" value="Add Job Posting">
            </form>
        </div>
    </div>
</body>
</html>
