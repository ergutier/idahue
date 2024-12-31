<?php
include_once '../data/IngActData.php';

class IngActBusiness {
    private $ingActData;

    public function __construct() {
        $this->ingActData = new IngActData();
    }

    public function getAll() {
        return $this->ingActData->readAll();
    }

    public function create($data) {
        return $this->ingActData->create($data);
    }

    public function update($data) {
        return $this->ingActData->update($data);
    }

    public function delete($id) {
        return $this->ingActData->delete($id);
    }
}
?>