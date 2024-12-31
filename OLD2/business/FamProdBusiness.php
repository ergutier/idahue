<?php
include_once '../data/FamProdData.php';

class FamProdBusiness {
    private $famProdData;

    public function __construct() {
        $this->famProdData = new FamProdData();
    }

    public function getAll() {
        return $this->famProdData->readAll();
    }

    public function create($data) {
        return $this->famProdData->create($data);
    }

    public function update($data) {
        return $this->famProdData->update($data);
    }

    public function delete($id) {
        return $this->famProdData->delete($id);
    }
}
?>