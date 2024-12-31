<?php
include_once 'Database.php';

class PersonaData {
    private $conn;
    private $table_name = "PERSONA";

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
        $query = "INSERT INTO " . $this->table_name . " SET id=:id, nombre=:nombre, Rut=:Rut, fono=:fono";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $data['id']);
        $stmt->bindParam(":nombre", $data['nombre']);
        $stmt->bindParam(":Rut", $data['Rut']);
        $stmt->bindParam(":fono", $data['fono']);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($data) {
        $query = "UPDATE " . $this->table_name . " SET nombre=:nombre, Rut=:Rut, fono=:fono WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $data['id']);
        $stmt->bindParam(":nombre", $data['nombre']);
        $stmt->bindParam(":Rut", $data['Rut']);
        $stmt->bindParam(":fono", $data['fono']);
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