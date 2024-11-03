<?php
class Session {
    private $conn;
    private $table = 'sessions';

    public $session_id;
    public $user_id;
    public $ip_address;
    public $last_activity;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function logout() {
        $query = "DELETE FROM " . $this->table . " WHERE session_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->session_id);
        return $stmt->execute();
    }
}
?>
