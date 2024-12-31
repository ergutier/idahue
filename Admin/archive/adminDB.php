<?php
include_once BASE_DR . 'DBaccess.php';

class AdminDB {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getTablas() {
        $query = "SHOW TABLES";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getTablaData($tabla) {
        $query = "SELECT * FROM " . $tabla;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getColumnas($tabla) {
        $query = "DESCRIBE " . $tabla;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getPrimaryKey($tabla) {
        $query = "SHOW KEYS FROM " . $tabla . " WHERE Key_name = 'PRIMARY'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Column_name'];
    }

    public function insertarRegistro($tabla, $datos) {
        $columnas = array_keys($datos);
        $valores = array_values($datos);

        $query = "INSERT INTO " . $tabla . " (" . implode(", ", $columnas) . ") VALUES (:" . implode(", :", $columnas) . ")";
        $stmt = $this->conn->prepare($query);

        foreach ($datos as $columna => $valor) {
            $stmt->bindValue(':' . $columna, $valor);
        }

        return $stmt->execute();
    }

    public function actualizarRegistro($tabla, $id, $datos, $primaryKey) {
        $columnas = array_keys($datos);
        $setClause = [];
        foreach ($columnas as $columna) {
            $setClause[] = $columna . " = :" . $columna;
        }

        $query = "UPDATE " . $tabla . " SET " . implode(", ", $setClause) . " WHERE " . $primaryKey . " = :" . $primaryKey;
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':' . $primaryKey, $id);

        foreach ($datos as $columna => $valor) {
            $stmt->bindValue(':' . $columna, $valor);
        }

        return $stmt->execute();
    }

    public function eliminarRegistro($tabla, $id, $primaryKey) {
        $query = "DELETE FROM " . $tabla . " WHERE " . $primaryKey . " = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}
?>