<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="/controllers/AuthController.php?action=login" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
