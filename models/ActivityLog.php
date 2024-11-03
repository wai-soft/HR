<?php
class ActivityLog {
    private $conn;
    private $table = 'activity_logs';

    public $id;
    public $user_id;
    public $activity;
    public $timestamp;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function log_activity() {
        $query = "INSERT INTO " . $this->table . " (user_id, activity, timestamp) VALUES (?, ?, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $this->user_id, $this->activity);
        return $stmt->execute();
    }
}
?>
