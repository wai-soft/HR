<?php
class Asset {
    private $conn;
    private $table = 'assets';

    public $id;
    public $name;
    public $description;
    public $assigned_to;
    public $assignment_date;
    public $return_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (name, description, assigned_to, assignment_date, return_date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssiss", $this->name, $this->description, $this->assigned_to, $this->assignment_date, $this->return_date);
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT a.id, a.name, a.description, e.name AS employee_name, a.assignment_date, a.return_date 
                  FROM " . $this->table . " a 
                  JOIN employees e ON a.assigned_to = e.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET name = ?, description = ?, assigned_to = ?, assignment_date = ?, return_date = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssissi", $this->name, $this->description, $this->assigned_to, $this->assignment_date, $this->return_date, $this->id);
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
