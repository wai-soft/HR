<?php
class SalaryDetails {
    private $conn;
    private $table = 'salary_details';

    public $id;
    public $salary_id;
    public $description;
    public $amount;
    public $type;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (salary_id, description, amount, type) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isds", $this->salary_id, $this->description, $this->amount, $this->type);
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table . " WHERE salary_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->salary_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET description = ?, amount = ?, type = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sdsi", $this->description, $this->amount, $this->type, $this->id);
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
}
?>
