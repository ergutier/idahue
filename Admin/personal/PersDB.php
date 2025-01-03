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
		try {
			$this->conn->beginTransaction();

			$query = "INSERT INTO PERSONA (rut, nombre, fono) VALUES (:rut, :nombre, :fono)";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':rut', $data['rut']);
			$stmt->bindParam(':nombre', $data['nombre']);
			$stmt->bindParam(':fono', $data['fono']);
			$stmt->execute();

			$this->conn->commit();
			return true;
		} catch (PDOException $e) {
			$this->conn->rollBack();
			throw $e;
		}
	}

	public function deletePersona($rut) {
		try {
			$this->conn->beginTransaction();

			$sql = "DELETE FROM fertilizacion WHERE ID_pers = :rut";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(':rut', $rut);
			$stmt->execute();

			$sql = "DELETE FROM rol_persona WHERE PERSONA_rut = :rut";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(':rut', $rut);
			$stmt->execute();

			$sql = "DELETE FROM persona WHERE rut = :rut";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(':rut', $rut);
			$stmt->execute();

			$this->conn->commit();
			echo "<p>Persona eliminada exitosamente.</p>";
		} catch (PDOException $e) {
			$this->conn->rollBack();
			throw $e;
		}
	}
		

    public function updatePersona($data) {
        $query = "UPDATE PERSONA SET nombre = :nombre, fono = :fono WHERE rut = :rut";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':rut', $data['rut']);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':fono', $data['fono']);
        return $stmt->execute();
    }

	/*blic function deletePersona($rut) {
		try {
			// Iniciar transacción
			$this->conn->beginTransaction();

			// Eliminar referencias en la tabla fertilizacion
			$sql = "DELETE FROM fertilizacion WHERE ID_pers = :rut";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(':rut', $rut);
			$stmt->execute();

			// Eliminar otras referencias en tablas dependientes según sea necesario
			// Ejemplo: Eliminar referencias en otra tabla dependiente
			$sql = "DELETE FROM rol_persona WHERE PERSONA_rut = :rut";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(':rut', $rut);
			$stmt->execute();

			// Eliminar persona
			$sql = "DELETE FROM persona WHERE rut = :rut";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(':rut', $rut);
			$stmt->execute();

			// Confirmar transacción
			$this->conn->commit();
			echo "<p>Persona eliminada exitosamente.</p>";
		} catch (PDOException $e) {
			// Revertir transacción en caso de error
			$this->conn->rollBack();
			throw $e;
		}
	}*/
    
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
