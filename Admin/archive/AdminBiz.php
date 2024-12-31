<?php
include_once BASE_DR . 'Admin/AdminDB.php';

class AdminBiz {
    private $adminDB;

    public function __construct() {
        $this->adminDB = new AdminDB();
    }

    public function getTablas() {
        $stmt = $this->adminDB->getTablas();
        $tables = [];
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            if (!$this->esTablaInterseccion($row[0])) {
                $tables[] = $row[0];
            }
        }
        return $tables;
    }

    public function getTablaData($tabla) {
        return $this->adminDB->getTablaData($tabla);
    }

    public function getColumnas($tabla) {
        return $this->adminDB->getColumnas($tabla);
    }

    public function getPrimaryKey($tabla) {
        return $this->adminDB->getPrimaryKey($tabla);
    }

    public function insertarRegistro($tabla, $datos) {
        return $this->adminDB->insertarRegistro($tabla, $datos);
    }

    public function actualizarRegistro($tabla, $id, $datos, $primaryKey) {
        return $this->adminDB->actualizarRegistro($tabla, $id, $datos, $primaryKey);
    }

    public function eliminarRegistro($tabla, $id, $primaryKey) {
        return $this->adminDB->eliminarRegistro($tabla, $id, $primaryKey);
    }

    public function esTablaInterseccion($tabla) {
        $columnas = $this->getColumnas($tabla);
        $pkCount = 0;
        while ($col = $columnas->fetch(PDO::FETCH_ASSOC)) {
            if (isset($col['Key']) && $col['Key'] == 'PRI') {
                $pkCount++;
            }
        }
        return $pkCount > 1;
    }

    public function getForeignTable($column) {
		// Mapea las columnas foráneas a nombres amigables de las tablas respectivas
		$foreignTables = [
			'ID_Fam' => ['table' => 'FAM_PROD', 'friendlyName' => 'Familia de Producto'],
			'ID_PROV' => ['table' => 'PROVEEDOR', 'friendlyName' => 'Proveedores'],
			'ID_INGACT' => ['table' => 'ING_ACT', 'friendlyName' => 'Ingredientes Activos'],
			'ID_pers' => ['table' => 'PERSONA', 'friendlyName' => 'Personas'],
			'ID_prod' => ['table' => 'PRODUCTO', 'friendlyName' => 'Productos'],
		];
		return $foreignTables[$column] ?? null;
	}

    public function getForeignKeyData($foreignTable) {
        return $this->adminDB->getTablaData($foreignTable);
    }
}
?>
