<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link rel="stylesheet" href="/public/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showAlert(type, title, text, redirectUrl = null) {
            Swal.fire({
                icon: type,
                title: title,
                text: text
            }).then((result) => {
                if (result.isConfirmed && redirectUrl) {
                    window.location.href = redirectUrl;
                }
            });
        }
    </script>
</head>
<body>
    <div class="header">
        <img src="https://wai-soft.com/wp-content/uploads/2019/07/wai-2.png" alt="Logo">
        <h1>HRM Dashboard</h1>
        <a href="/controllers/AuthController.php?action=logout" class="button">Logout</a>
    </div>
