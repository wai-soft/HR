<?php
class Loan {
    private $conn;
    private $table = 'loans';

    public $id;
    public $employee_id;
    public $amount;
    public $issue_date;
    public $repayment_date;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (employee_id, amount, issue_date, repayment_date, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("idsss", $this->employee_id, $this->amount, $this->issue_date, $this->repayment_date, $this->status);
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table . " WHERE employee_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->employee_id);
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
        $query = "UPDATE " . $this->table . " SET employee_id = ?, amount = ?, issue_date = ?, repayment_date = ?, status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("idsssi", $this->employee_id, $this->amount, $this->issue_date, $this->repayment_date, $this->status, $this->id);
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
