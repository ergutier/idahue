<?php
include_once 'Database.php';

class FamProdData {
    private $conn;
    private $table_name = "FAM_PROD";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " SET id=:id, username=:username, role=:role, created_at=:created_at";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $data['id']);
        $stmt->bindParam(":username", $data['username']);
        $stmt->bindParam(":role", $data['role']);
        $stmt->bindParam(":created_at", $data['created_at']);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($data) {
        $query = "UPDATE " . $this->table_name . " SET username=:username, role=:role, created_at=:created_at WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $data['id']);
        $stmt->bindParam(":username", $data['username']);
        $stmt->bindParam(":role", $data['role']);
        $stmt->bindParam(":created_at", $data['created_at']);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>