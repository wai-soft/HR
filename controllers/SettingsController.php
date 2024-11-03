<?php
include '../config/db_connection.php';

$action = $_GET['action'];

if ($action == 'customize' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $theme_color = $_POST['theme_color'];
    $layout = $_POST['layout'];

    $settings = [
        'theme_color' => $theme_color,
        'layout' => $layout
    ];
    file_put_contents('../config/settings.json', json_encode($settings));

    echo "<script>alert('Settings saved successfully'); window.location.href='/views/settings/customize_interface.php';</script>";
}
?>
