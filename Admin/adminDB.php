<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/DBaccess.php';

class AdminDB {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getTablas() {
        $stmt = $this->conn->query("SHOW TABLES");
        return $stmt;
    }
}
?>
