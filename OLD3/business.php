<?php
include_once 'database.php';

$database = new Database();
$db = $database->getConnection();

if (isset($_POST['persona'])) {
    $persona = htmlspecialchars(strip_tags($_POST['persona']));
    $stmt = $database->getRolesAsignados($persona);
    $roles_asignados = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $roles_asignados[] = $row['ROL_id'];
    }

    echo json_encode($roles_asignados);
}


class Negocio {
    private $database;

    public function __construct() {
        $this->database = new Database();
        $this->db = $this->database->getConnection();
    }

    public function getPersonas() {
        return $this->database->getPersonas();
    }

    public function getRoles() {
        return $this->database->getRoles();
    }

    public function getRolesAsignados($persona) {
        return $this->database->getRolesAsignados($persona);
    }

    public function asignarRoles($persona, $roles) {
        $this->database->deleteRolesPersona($persona);
        foreach ($roles as $rol) {
            $this->database->assignRolesPersona($persona, $rol);
        }
    }

    public function getFertilizaciones() {
        $query = "SELECT FERTILIZACION.ID_pers, PERSONA.nombre AS nombre_persona, FERTILIZACION.ID_prod, PRODUCTO.especie AS nombre_producto, FERTILIZACION.fecha, FERTILIZACION.hora_i, FERTILIZACION.hora_f, FERTILIZACION.conc_prod, FERTILIZACION.dosis
                  FROM FERTILIZACION
                  JOIN PERSONA ON FERTILIZACION.ID_pers = PERSONA.rut
                  JOIN PRODUCTO ON FERTILIZACION.ID_prod = PRODUCTO.id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function registrarFertilizacion($ID_pers, $ID_prod, $fecha, $hora_i, $hora_f, $conc_prod, $dosis) {
        $query = "INSERT INTO FERTILIZACION (ID_pers, ID_prod, fecha, hora_i, hora_f, conc_prod, dosis) VALUES (:ID_pers, :ID_prod, :fecha, :hora_i, :hora_f, :conc_prod, :dosis)";
        $stmt = $this->db->prepare($query);
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
