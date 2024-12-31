<?php
include_once '../data/ProductoData.php';

class ProductoBusiness {
    private $productoData;

    public function __construct() {
        $this->productoData = new ProductoData();
    }

    public function getAll() {
        return $this->productoData->readAll();
    }

    public function create($data) {
        return $this->productoData->create($data);
    }

    public function update($data) {
        return $this->productoData->update($data);
    }

    public function delete($id) {
        return $this->productoData->delete($id);
    }
}
?>