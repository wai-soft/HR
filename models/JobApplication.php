<?php
class JobApplication {
    private $conn;
    private $table = 'job_applications';

    public $id;
    public $job_posting_id;
    public $applicant_name;
    public $applicant_email;
    public $resume_path;
    public $application_date;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (job_posting_id, applicant_name, applicant_email, resume_path, application_date, status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isssss", $this->job_posting_id, $this->applicant_name, $this->applicant_email, $this->resume_path, $this->application_date, $this->status);
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
        $query = "UPDATE " . $this->table . " SET job_posting_id = ?, applicant_name = ?, applicant_email = ?, resume_path = ?, application_date = ?, status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isssssi", $this->job_posting_id, $this->applicant_name, $this->applicant_email, $this->resume_path, $this->application_date, $this->status, $this->id);
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