<?php
include '../config/db_connection.php';
include '../models/Employee.php';

$action = $_GET['action'];

if ($action == 'add' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $conn->begin_transaction();
    try {
        $employee = new Employee($conn);
        $employee->name = $_POST['name'];
        $employee->email = $_POST['email'];
        $employee->phone = $_POST['phone'];
        $employee->address = $_POST['address'];
        $employee->hire_date = $_POST['hire_date'];
        $employee->qualifications = $_POST['qualifications'];
        $employee->company_id = $_POST['company_id'];
        $employee->department_id = $_POST['department_id'];
        $password = $_POST['password'];

        $checkUserQuery = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($checkUserQuery);
        $stmt->bind_param("s", $employee->email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            throw new Exception('Error: Email is already registered. Please use a different email.');
        }
        $stmt->close();

        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
            if (!move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                throw new Exception('Error: Error uploading profile picture');
            }
            $employee->profile_picture = $target_file;
        }

        if ($employee->create()) {
            $username = $employee->email;
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $role = 'employee';
            $roleId = 3;

            $sqlUser = "INSERT INTO users (username, password, role, role_id) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sqlUser);
            $stmt->bind_param("sssi", $username, $hashedPassword, $role, $roleId);
            if (!$stmt->execute()) {
                throw new Exception('Error: Error creating user account: ' . $stmt->error);
            }
            $userId = $conn->insert_id;

            $sqlUpdateEmployee = "UPDATE employees SET user_id = ? WHERE id = ?";
            $stmtUpdate = $conn->prepare($sqlUpdateEmployee);
            $stmtUpdate->bind_param("ii", $userId, $employee->id);
            if (!$stmtUpdate->execute()) {
                throw new Exception('Error: Error updating employee with user ID: ' . $stmtUpdate->error);
            }
            $conn->commit();
            echo "<script>
                    alert('Employee and user account added successfully');
                    window.location.href = '/views/employees/view_employees.php';
                  </script>";
            exit();
        } else {
            throw new Exception('Error: ' . $conn->error);
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>
                alert('" . $e->getMessage() . "');
                window.history.back();
              </script>";
        exit();
    }
}

if ($action == 'edit' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $conn->begin_transaction();
    try {
        $employee = new Employee($conn);
        $employee->id = $_POST['id'];
        $employee->name = $_POST['name'];
        $employee->email = $_POST['email'];
        $employee->phone = $_POST['phone'];
        $employee->address = $_POST['address'];
        $employee->hire_date = $_POST['hire_date'];
        $employee->qualifications = $_POST['qualifications'];
        $employee->company_id = $_POST['company_id'];
        $employee->department_id = $_POST['department_id'];

        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
            if (!move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                throw new Exception('Error: Error uploading profile picture');
            }
            $employee->profile_picture = $target_file;
        }

        if ($employee->update()) {
            $conn->commit();
            echo "<script>
                    alert('Employee updated successfully');
                    window.location.href = '/views/employees/view_employees.php';
                  </script>";
            exit();
        } else {
            throw new Exception('Error: ' . $conn->error);
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>
                alert('" . $e->getMessage() . "');
                window.history.back();
              </script>";
        exit();
    }
}

if ($action == 'delete' && isset($_GET['id'])) {
    $conn->begin_transaction();
    try {
        $employee = new Employee($conn);
        $employee->id = $_GET['id'];

        if ($employee->delete()) {
            $conn->commit();
            echo "<script>
                    alert('Employee deleted successfully');
                    window.location.href = '/views/employees/view_employees.php';
                  </script>";
            exit();
        } else {
            throw new Exception('Error: ' . $conn->error);
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>
                alert('" . $e->getMessage() . "');
                window.history.back();
              </script>";
        exit();
    }
}
?>
