<?php
include_once '../data/PersonaData.php';

class PersonaBusiness {
    private $personaData;

    public function __construct() {
        $this->personaData = new PersonaData();
    }

    public function getAll() {
        return $this->personaData->readAll();
    }

    public function create($data) {
        return $this->personaData->create($data);
    }

    public function update($data) {
        return $this->personaData->update($data);
    }

    public function delete($id) {
        return $this->personaData->delete($id);
    }
}
?>