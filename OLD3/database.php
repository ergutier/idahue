<?php
class Database {
    private $host = "localhost";
    private $db_name = "idahue";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

    // Función para obtener todas las personas
    public function getPersonas() {
        $query = "SELECT rut, nombre FROM PERSONA";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Función para obtener todos los roles
    public function getRoles() {
        $query = "SELECT id, nombre FROM ROL";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Función para eliminar roles de una persona
    public function deleteRolesPersona($persona) {
        $query = "DELETE FROM ROL_PERSONA WHERE PERSONA_rut = :persona";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':persona', $persona);
        return $stmt->execute();
    }

    // Función para asignar roles a una persona
    public function assignRolesPersona($persona, $rol) {
        $query = "INSERT INTO ROL_PERSONA (ROL_id, PERSONA_rut) VALUES (:rol, :persona)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':persona', $persona);
        return $stmt->execute();
    }

    // Función para obtener roles asignados a una persona
    public function getRolesAsignados($persona) {
        $query = "SELECT ROL_id FROM ROL_PERSONA WHERE PERSONA_rut = :persona";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':persona', $persona);
        $stmt->execute();
        return $stmt;
    }
}
?>