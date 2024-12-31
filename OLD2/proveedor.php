<?php
include_once 'Database.php';

class ProveedorData {
    private $conn;
    private $table_name = "PROVEEDOR";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " SET id=:id, RUT=:RUT, Nombre=:Nombre, direccion=:direccion, fono=:fono, contacto=:contacto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $data['id']);
        $stmt->bindParam(":RUT", $data['RUT']);
        $stmt->bindParam(":Nombre", $data['Nombre']);
        $stmt->bindParam(":direccion", $data['direccion']);
        $stmt->bindParam(":fono", $data['fono']);
        $stmt->bindParam(":contacto", $data['contacto']);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($data) {
        $query = "UPDATE " . $this->table_name . " SET RUT=:RUT, Nombre=:Nombre, direccion=:direccion, fono=:fono, contacto=:contacto WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $data['id']);
        $stmt->bindParam(":RUT", $data['RUT']);
        $stmt->bindParam(":Nombre", $data['Nombre']);
        $stmt->bindParam(":direccion", $data['direccion']);
        $stmt->bindParam(":fono", $data['fono']);
        $stmt->bindParam(":contacto", $data['contacto']);
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