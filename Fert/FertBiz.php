<?php
include_once BASE_DR . 'Fert/FertDB.php';

class FertBiz {
    private $fertDB;

    public function __construct() {
        $this->fertDB = new FertDB();
    }

    public function getPersonas() {
        return $this->fertDB->getPersonas();
    }

    public function getProductos() {
        return $this->fertDB->getProductos();
    }

    public function registrarFertilizacion($ID_pers, $ID_prod, $fecha, $hora_i, $hora_f, $conc_prod, $dosis) {
        return $this->fertDB->registrarFertilizacion($ID_pers, $ID_prod, $fecha, $hora_i, $hora_f, $conc_prod, $dosis);
    }
}
?>
