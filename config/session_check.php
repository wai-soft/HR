<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /views/auth/login.php");
    exit();
}
?>
