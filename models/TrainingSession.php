<?php
class TrainingSession {
    private $conn;
    private $table = 'training_sessions';

    public $id;
    public $employee_id;
    public $course_name;
    public $start_date;
    public $end_date;
    public $status;
    public $start_date;
    public $end_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (employee_id, course_name, start_date, end_date, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issss", $this->employee_id, $this->course_name, $this->start_date, $this->end_date, $this->status);
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
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
