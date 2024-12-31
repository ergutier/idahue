<?php
include_once dirname(__DIR__) . '/config.php';

class FertilizacionData {
    private $conn;
    private $table_name = "FERTILIZACION";

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
        $query = "INSERT INTO " . $this->table_name . " SET ID_pers=:ID_pers, ID_prod=:ID_prod, fecha=:fecha, hora_i=:hora_i, hora_f=:hora_f, conc_prod=:conc_prod, dosis=:dosis";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ID_pers", $data['ID_pers']);
        $stmt->bindParam(":ID_prod", $data['ID_prod']);
        $stmt->bindParam(":fecha", $data['fecha']);
        $stmt->bindParam(":hora_i", $data['hora_i']);
        $stmt->bindParam(":hora_f", $data['hora_f']);
        $stmt->bindParam(":conc_prod", $data['conc_prod']);
        $stmt->bindParam(":dosis", $data['dosis']);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($data) {
        $query = "UPDATE " . $this->table_name . " SET fecha=:fecha, hora_i=:hora_i, hora_f=:hora_f, conc_prod=:conc_prod, dosis=:dosis WHERE ID_pers=:ID_pers AND ID_prod=:ID_prod";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ID_pers", $data['ID_pers']);
        $stmt->bindParam(":ID_prod", $data['ID_prod']);
        $stmt->bindParam(":fecha", $data['fecha']);
        $stmt->bindParam(":hora_i", $data['hora_i']);
        $stmt->bindParam(":hora_f", $data['hora_f']);
        $stmt->bindParam(":conc_prod", $data['conc_prod']);
        $stmt->bindParam(":dosis", $data['dosis']);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($ID_pers, $ID_prod) {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_pers=:ID_pers AND ID_prod=:ID_prod";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ID_pers", $ID_pers);
        $stmt->bindParam(":ID_prod", $ID_prod);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>