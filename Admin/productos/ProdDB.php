<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/idahue/DBaccess.php';

class ProdDB {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getProductos() {
        $query = "SELECT id, nombre, especie, cantidad, Fecha_venc FROM PRODUCTO";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getFamilias() {
        $query = "SELECT id, nombre FROM FAMILIA";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getProveedores() {
        $query = "SELECT rut, nombre FROM PROVEEDOR";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getIngredientesActivos() {
        $query = "SELECT id, nombre FROM ING_ACT";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function addProducto($data) {
        $query = "INSERT INTO PRODUCTO (nombre, ID_Fam, ID_PROV, ID_INGACT, cantidad, Fecha_venc, especie) VALUES (:nombre, :ID_Fam, :ID_PROV, :ID_INGACT, :cantidad, :Fecha_venc, :especie)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':ID_Fam', $data['ID_Fam']);
        $stmt->bindParam(':ID_PROV', $data['ID_PROV']);
        $stmt->bindParam(':ID_INGACT', $data['ID_INGACT']);
        $stmt->bindParam(':cantidad', $data['cantidad']);
        $stmt->bindParam(':Fecha_venc', $data['Fecha_venc']);
        $stmt->bindParam(':especie', $data['especie']);
        return $stmt->execute();
    }

    public function updateProducto($data) {
        $query = "UPDATE PRODUCTO SET nombre = :nombre, ID_Fam = :ID_Fam, ID_PROV = :ID_PROV, ID_INGACT = :ID_INGACT, cantidad = :cantidad, Fecha_venc = :Fecha_venc, especie = :especie WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':ID_Fam', $data['ID_Fam']);
        $stmt->bindParam(':ID_PROV', $data['ID_PROV']);
        $stmt->bindParam(':ID_INGACT', $data['ID_INGACT']);
        $stmt->bindParam(':cantidad', $data['cantidad']);
        $stmt->bindParam(':Fecha_venc', $data['Fecha_venc']);
        $stmt->bindParam(':especie', $data['especie']);
        return $stmt->execute();
    }

    public function deleteProducto($id) {
        $query = "DELETE FROM PRODUCTO WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getProductoIngredientes($productoId) {
        $query = "SELECT ING_ACT.* FROM ING_ACT INNER JOIN PRODUCTO_ING_ACT ON ING_ACT.id = PRODUCTO_ING_ACT.ING_ACT_id WHERE PRODUCTO_ING_ACT.PRODUCTO_ID_INGACT = :productoId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':productoId', $productoId);
        $stmt->execute();
        return $stmt;
    }

    public function addProductoIngrediente($data) {
        $query = "INSERT INTO PRODUCTO_ING_ACT (PRODUCTO_ID_INGACT, ING_ACT_id) VALUES (:PRODUCTO_ID_INGACT, :ING_ACT_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':PRODUCTO_ID_INGACT', $data['PRODUCTO_ID_INGACT']);
        $stmt->bindParam(':ING_ACT_id', $data['ING_ACT_id']);
        return $stmt->execute();
    }

    public function deleteProductoIngrediente($data) {
        $query = "DELETE FROM PRODUCTO_ING_ACT WHERE PRODUCTO_ID_INGACT = :PRODUCTO_ID_INGACT AND ING_ACT_id = :ING_ACT_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':PRODUCTO_ID_INGACT', $data['PRODUCTO_ID_INGACT']);
        $stmt->bindParam(':ING_ACT_id', $data['ING_ACT_id']);
        return $stmt->execute();
    }
}
?>