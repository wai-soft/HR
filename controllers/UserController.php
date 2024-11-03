<?php
include '../config/db_connection.php';
include '../models/User.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$action = $_GET['action'] ?? '';

if ($action == 'add' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $conn->begin_transaction();

    try {
        $user = new User($conn);
        $user->username = $_POST['username'];
        $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user->role_id = $_POST['role_id'];

        
        $checkUserQuery = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($checkUserQuery);
        $stmt->bind_param("s", $user->username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>
                    alert('Error: Username is already taken. Please use a different username.');
                    window.history.back();
                  </script>";
            $stmt->close();
            $conn->rollback();
            exit();
        }
        $stmt->close();

        if ($user->create()) {
            $conn->commit();
            echo "<script>
                    alert('User added successfully');
                    window.location.href = '/views/users/view_users.php';
                  </script>";
            exit();
        } else {
            throw new Exception("Error: " . $conn->error);
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>
                alert('Error: " . $e->getMessage() . "');
                window.history.back();
              </script>";
        exit();
    }
}

if ($action == 'edit' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $conn->begin_transaction();

    try {
        $user = new User($conn);
        $user->id = $_POST['id'];
        $user->username = $_POST['username'];

        if (!empty($_POST['password'])) {
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        $user->role_id = $_POST['role_id'];

        $checkUserQuery = "SELECT * FROM users WHERE username = ? AND id != ?";
        $stmt = $conn->prepare($checkUserQuery);
        $stmt->bind_param("si", $user->username, $user->id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>
                    alert('Error: Username is already taken. Please use a different username.');
                    window.history.back();
                  </script>";
            $stmt->close();
            $conn->rollback();
            exit();
        }
        $stmt->close();

        if ($user->update()) {
            $conn->commit();
            echo "<script>
                    alert('User updated successfully');
                    window.location.href = '/views/users/view_users.php';
                  </script>";
            exit();
        } else {
            throw new Exception("Error: " . $conn->error);
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>
                alert('Error: " . $e->getMessage() . "');
                window.history.back();
              </script>";
        exit();
    }
}

if ($action == 'delete' && isset($_GET['id'])) {
    $conn->begin_transaction();

    try {
        $user = new User($conn);
        $user->id = $_GET['id'];

        if ($user->delete()) {
            $conn->commit();
            echo "<script>
                    alert('User deleted successfully');
                    window.location.href = '/views/users/view_users.php';
                  </script>";
            exit();
        } else {
            throw new Exception("Error: " . $conn->error);
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>
                alert('Error: " . $e->getMessage() . "');
                window.history.back();
              </script>";
        exit();
    }
}
?>
