<?php
include_once BASE_DR . 'DBaccess.php';

class RepFertDB {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getFertilizaciones() {
        $query = "SELECT FERTILIZACION.ID_pers, PERSONA.nombre AS nombre_persona, FERTILIZACION.ID_prod, PRODUCTO.especie AS nombre_producto, FERTILIZACION.fecha, FERTILIZACION.hora_i, FERTILIZACION.hora_f, FERTILIZACION.conc_prod, FERTILIZACION.dosis
                  FROM FERTILIZACION
                  JOIN PERSONA ON FERTILIZACION.ID_pers = PERSONA.rut
                  JOIN PRODUCTO ON FERTILIZACION.ID_prod = PRODUCTO.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
