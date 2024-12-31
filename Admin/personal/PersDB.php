<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/DBaccess.php';

class PersDB {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getPersonas() {
        $query = "SELECT rut, nombre, fono FROM PERSONA";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getRoles() {
        $query = "SELECT id, nombre FROM ROL";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function addPersona($data) {
        $query = "INSERT INTO PERSONA (rut, nombre, fono) VALUES (:rut, :nombre, :fono)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':rut', $data['rut']);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':fono', $data['fono']);
        return $stmt->execute();
    }

    public function updatePersona($data) {
        $query = "UPDATE PERSONA SET nombre = :nombre, fono = :fono WHERE rut = :rut";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':rut', $data['rut']);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':fono', $data['fono']);
        return $stmt->execute();
    }

    public function deletePersona($rut) {
        $query = "DELETE FROM ROL_PERSONA, PERSONA WHERE rut = :rut";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':rut', $rut);
        return $stmt->execute();
    }

    public function assignRole($data) {
        $query = "INSERT INTO ROL_PERSONA (ROL_id, PERSONA_rut) VALUES (:ROL_id, :PERSONA_rut)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ROL_id', $data['ROL_id']);
        $stmt->bindParam(':PERSONA_rut', $data['PERSONA_rut']);
        return $stmt->execute();
    }

    public function removeRole($data) {
        $query = "DELETE FROM ROL_PERSONA WHERE ROL_id = :ROL_id AND PERSONA_rut = :PERSONA_rut";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ROL_id', $data['ROL_id']);
        $stmt->bindParam(':PERSONA_rut', $data['PERSONA_rut']);
        return $stmt->execute();
    }
}
?>
