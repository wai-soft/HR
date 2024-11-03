<?php
class Document {
    private $conn;
    private $table = 'documents';

    public $id;
    public $employee_id;
    public $document_name;
    public $document_path;
    public $upload_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (employee_id, document_name, document_path, upload_date) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isss", $this->employee_id, $this->document_name, $this->document_path, $this->upload_date);
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
        $query = "UPDATE " . $this->table . " SET employee_id = ?, document_name = ?, document_path = ?, upload_date = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isssi", $this->employee_id, $this->document_name, $this->document_path, $this->upload_date, $this->id);
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
