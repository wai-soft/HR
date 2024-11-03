<?php
class PerformanceReview {
    private $conn;
    private $table = 'performance_reviews';

    public $id;
    public $employee_id;
    public $review_date;
    public $score;
    public $comments;
    public $start_date;
    public $end_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (employee_id, review_date, score, comments) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isis", $this->employee_id, $this->review_date, $this->score, $this->comments);
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function generate_report() {
        $query = "SELECT * FROM " . $this->table . " WHERE employee_id = ? AND review_date >= ? AND review_date <= ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iss", $this->employee_id, $this->start_date, $this->end_date);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
