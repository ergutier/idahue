<?php
include_once BASE_DR . 'Admin/Productos/prodDB.php';

class ProdBiz {
    private $prodDB;

    public function __construct() {
        $this->prodDB = new ProdDB();
    }

    public function getProductos() {
        return $this->prodDB->getProductos();
    }

    public function getProveedores() {
        return $this->prodDB->getProveedores();
    }

    public function getIngredientesActivos() {
        return $this->prodDB->getIngredientesActivos();
    }

    public function addProducto($data) {
        return $this->prodDB->addProducto($data);
    }

    public function updateProducto($data) {
        return $this->prodDB->updateProducto($data);
    }

    public function deleteProducto($id) {
        return $this->prodDB->deleteProducto($id);
    }

    public function getProductoIngredientes($productoId) {
        return $this->prodDB->getProductoIngredientes($productoId);
    }

    public function addProductoIngrediente($data) {
        return $this->prodDB->addProductoIngrediente($data);
    }

    public function deleteProductoIngrediente($data) {
        return $this->prodDB->deleteProductoIngrediente($data);
    }
}
?>
