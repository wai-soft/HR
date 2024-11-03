<?php
class RolePermission {
    private $conn;
    private $table = 'role_permissions';

    public $role_id;
    public $permission_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (role_id, permission_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->role_id, $this->permission_id);
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table . " WHERE role_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->role_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE role_id = ? AND permission_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->role_id, $this->permission_id);
        return $stmt->execute();
    }

    public function delete_all() {
        $query = "DELETE FROM " . $this->table . " WHERE role_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->role_id);
        return $stmt->execute();
    }
}
?>
