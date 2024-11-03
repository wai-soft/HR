<?php
class Attendance {
    private $conn;
    private $table = 'attendance';

    public $id;
    public $employee_id;
    public $check_in;
    public $check_out;
    public $start_date;
    public $end_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (employee_id, check_in, check_out) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iss", $this->employee_id, $this->check_in, $this->check_out);
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function generate_report() {
        $query = "SELECT * FROM " . $this->table . " WHERE employee_id = ? AND check_in >= ? AND check_out <= ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iss", $this->employee_id, $this->start_date, $this->end_date);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
