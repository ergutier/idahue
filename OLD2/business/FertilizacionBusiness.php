<?php
include_once '../data/FertilizacionData.php';

class FertilizacionBusiness {
    private $fertilizacionData;

    public function __construct() {
        $this->fertilizacionData = new FertilizacionData();
    }

    public function getAll() {
        return $this->fertilizacionData->readAll();
    }

    public function create($data) {
        return $this->fertilizacionData->create($data);
    }

    public function update($data) {
        return $this->fertilizacionData->update($data);
    }

    public function delete($id) {
        return $this->fertilizacionData->delete($id);
    }
}
?>