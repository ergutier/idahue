<?php
include_once BASE_DR . 'DBaccess.php';

class RolesDB {
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

    public function getRoles() {
        $query = "SELECT id, nombre FROM ROL";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getRolesAsignados($persona) {
        $query = "SELECT ROL_id FROM ROL_PERSONA WHERE PERSONA_rut = :persona";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':persona', $persona);
        $stmt->execute();
        return $stmt;
    }

    public function deleteRolesPersona($persona) {
        $query = "DELETE FROM ROL_PERSONA WHERE PERSONA_rut = :persona";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':persona', $persona);
        return $stmt->execute();
    }

    public function assignRolesPersona($persona, $rol) {
        $query = "INSERT INTO ROL_PERSONA (ROL_id, PERSONA_rut) VALUES (:rol, :persona)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':persona', $persona);
        return $stmt->execute();
    }
}
?>
