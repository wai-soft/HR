<?php
class Permission {
    private $conn;
    private $table = 'permissions';

    public $id;
    public $name;
    public $description;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (name, description) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            error_log("Error preparing statement: " . $this->conn->error, 3, '../log/file.log');
            return false;
        }
        $stmt->bind_param("ss", $this->name, $this->description);
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            error_log("Error preparing statement: " . $this->conn->error, 3, '../log/file.log');
            return false;
        }
        $stmt->execute();
        return $stmt->get_result();
    }

    public function read_single() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            error_log("Error preparing statement: " . $this->conn->error, 3, '../log/file.log');
            return false;
        }
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET name = ?, description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            error_log("Error preparing statement: " . $this->conn->error, 3, '../log/file.log');
            return false;
        }
        $stmt->bind_param("ssi", $this->name, $this->description, $this->id);
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            error_log("Error preparing statement: " . $this->conn->error, 3, '../log/file.log');
            return false;
        }
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
}
?>
