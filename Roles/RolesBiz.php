<?php
include_once BASE_DR . 'Roles/RolesDB.php';

class RolesBiz {
    private $rolesDB;

    public function __construct() {
        $this->rolesDB = new RolesDB();
    }

    public function getPersonas() {
        return $this->rolesDB->getPersonas();
    }

    public function getRoles() {
        return $this->rolesDB->getRoles();
    }

    public function getRolesAsignados($persona) {
        return $this->rolesDB->getRolesAsignados($persona);
    }	

    public function asignarRoles($persona, $roles) {
        $this->rolesDB->deleteRolesPersona($persona);
        foreach ($roles as $rol) {
            $this->rolesDB->assignRolesPersona($persona, $rol);
        }
    }
}
?>
