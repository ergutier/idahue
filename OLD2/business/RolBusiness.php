<?php
include_once '../data/RolData.php';

class RolBusiness {
    private $rolData;

    public function __construct() {
        $this->rolData = new RolData();
    }

    public function getAll() {
        return $this->rolData->readAll();
    }

    public function create($data) {
        return $this->rolData->create($data);
    }

    public function update($data) {
        return $this->rolData->update($data);
    }

    public function delete($id) {
        return $this->rolData->delete($id);
    }
}
?>