<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/DBaccess.php';

class FertDB {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getPersonas() {
        $query = "SELECT rut, nombre FROM PERSONA";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getProductos() {
        $query = "SELECT id, especie FROM PRODUCTO";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function registrarFertilizacion($ID_pers, $ID_prod, $fecha, $hora_i, $hora_f, $conc_prod, $dosis) {
        $query = "INSERT INTO FERTILIZACION (ID_pers, ID_prod, fecha, hora_i, hora_f, conc_prod, dosis) VALUES (:ID_pers, :ID_prod, :fecha, :hora_i, :hora_f, :conc_prod, :dosis)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ID_pers', $ID_pers);
        $stmt->bindParam(':ID_prod', $ID_prod);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora_i', $hora_i);
        $stmt->bindParam(':hora_f', $hora_f);
        $stmt->bindParam(':conc_prod', $conc_prod);
        $stmt->bindParam(':dosis', $dosis);
        return $stmt->execute();
    }
}
?>

