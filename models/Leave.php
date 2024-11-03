<?php
class Leave {
    private $conn;
    private $table = 'leaves';

    public $id;
    public $employee_id;
    public $start_date;
    public $end_date;
    public $reason;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (employee_id, start_date, end_date, reason, status) VALUES (?, ?, ?, ?, 'pending')";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isss", $this->employee_id, $this->start_date, $this->end_date, $this->reason);
        return $stmt->execute();
    }

    public function read_pending() {
        $query = "SELECT * FROM " . $this->table . " WHERE status = 'pending'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function read_all() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function update_status() {
        $query = "UPDATE " . $this->table . " SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $this->status, $this->id);
        return $stmt->execute();
    }

    public function generate_report() {
        $query = "SELECT * FROM " . $this->table . " WHERE employee_id = ? AND start_date >= ? AND end_date <= ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iss", $this->employee_id, $this->start_date, $this->end_date);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
