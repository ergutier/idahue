<?php
include_once 'Database.php';

class ProductoData {
    private $conn;
    private $table_name = "PRODUCTO";

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
        $query = "INSERT INTO " . $this->table_name . " SET id=:id, ID_Fam=:ID_Fam, ID_PROV=:ID_PROV, ID_INGACT=:ID_INGACT, cantidad=:cantidad, Fecha_venc=:Fecha_venc, especie=:especie";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $data['id']);
        $stmt->bindParam(":ID_Fam", $data['ID_Fam']);
        $stmt->bindParam(":ID_PROV", $data['ID_PROV']);
		  $stmt->bindParam(":ID_INGACT", $data['ID_INGACT']);
        $stmt->bindParam(":cantidad", $data['cantidad']);
        $stmt->bindParam(":Fecha_venc", $data['Fecha_venc']);
        $stmt->bindParam(":especie", $data['especie']);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($data) {
        $query = "UPDATE " . $this->table_name . " SET ID_Fam=:ID_Fam, ID_PROV=:ID_PROV, ID_INGACT=:ID_INGACT, cantidad=:cantidad, Fecha_venc=:Fecha_venc, especie=:especie WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $data['id']);
        $stmt->bindParam(":ID_Fam", $data['ID_Fam']);
        $stmt->bindParam(":ID_PROV", $data['ID_PROV']);
        $stmt->bindParam(":ID_INGACT", $data['ID_INGACT']);
        $stmt->bindParam(":cantidad", $data['cantidad']);
        $stmt->bindParam(":Fecha_venc", $data['Fecha_venc']);
        $stmt->bindParam(":especie", $data['especie']);
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