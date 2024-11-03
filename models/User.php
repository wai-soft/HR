<?php
class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $username;
    public $password;
    public $role_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "INSERT INTO " . $this->table . " (username, password, role_id) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $this->username, $hashedPassword, $this->role_id);
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT u.id, u.username, r.name as role FROM " . $this->table . " u JOIN roles r ON u.role_id = r.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function read_single() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function update() {
        if (!empty($this->password)) {
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $query = "UPDATE " . $this->table . " SET username = ?, password = ?, role_id = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssii", $this->username, $hashedPassword, $this->role_id, $this->id);
        } else {
            $query = "UPDATE " . $this->table . " SET username = ?, role_id = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sii", $this->username, $this->role_id, $this->id);
        }
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }

    public function has_permission($permission_name) {
        $query = "SELECT p.name FROM permissions p
                  JOIN role_permissions rp ON p.id = rp.permission_id
                  JOIN roles r ON rp.role_id = r.id
                  JOIN users u ON r.id = u.role_id
                  WHERE u.id = ? AND p.name = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            error_log("Error preparing statement: " . $this->conn->error, 3, '/path/to/your/log/file.log');
            return false;
        }
        $stmt->bind_param("is", $this->id, $permission_name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
}
?>
