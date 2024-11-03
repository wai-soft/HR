<?php
class Salary {
    private $conn;
    private $table = 'salaries';

    public $id;
    public $employee_id;
    public $basic_salary;
    public $allowances;
    public $deductions;
    public $net_salary;
    public $payment_date;
    public $start_date;
    public $end_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (employee_id, basic_salary, allowances, deductions, net_salary, payment_date) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("idddds", $this->employee_id, $this->basic_salary, $this->allowances, $this->deductions, $this->net_salary, $this->payment_date);
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table;
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
        $query = "UPDATE " . $this->table . " SET employee_id = ?, basic_salary = ?, allowances = ?, deductions = ?, net_salary = ?, payment_date = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("idddds", $this->employee_id, $this->basic_salary, $this->allowances, $this->deductions, $this->net_salary, $this->payment_date, $this->id);
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }

    public function generate_report() {
        $query = "SELECT * FROM " . $this->table . " WHERE employee_id = ? AND payment_date BETWEEN ? AND ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iss", $this->employee_id, $this->start_date, $this->end_date);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
