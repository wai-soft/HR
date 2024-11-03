<?php include '../../config/session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Customize Interface</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
</head>
<body>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/sidebar.php'; ?>
    <div class="main-content">
        <div class="form-container">
            <h1>Customize Interface</h1>
            <form action="/controllers/SettingsController.php?action=customize" method="post">
                <label for="theme_color">Theme Color:</label>
                <input type="color" id="theme_color" name="theme_color" value="#ffffff"><br><br>
                <label for="layout">Layout:</label>
                <select id="layout" name="layout">
                    <option value="default">Default</option>
                    <option value="compact">Compact</option>
                </select><br><br>
                <input type="submit" value="Save Settings">
            </form>
        </div>
    </div>
</body>
</html>
