<?php
include_once BASE_DR . 'Admin/Personal/PersDB.php';

class PersBiz {
    private $persDB;

    public function __construct() {
        $this->persDB = new PersDB();
    }

    public function getPersonas() {
        return $this->persDB->getPersonas();
    }

    public function getRoles() {
        return $this->persDB->getRoles();
    }

    public function addPersona($data) {
        return $this->persDB->addPersona($data);
    }

    public function updatePersona($data) {
        return $this->persDB->updatePersona($data);
    }

    public function deletePersona($rut) {
        return $this->persDB->deletePersona($rut);
    }

    public function assignRole($data) {
        return $this->persDB->assignRole($data);
    }

    public function removeRole($data) {
        return $this->persDB->removeRole($data);
    }
}
?>
