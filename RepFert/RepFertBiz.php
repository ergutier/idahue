<?php
include_once BASE_DR . 'RepFert/RepFertDB.php';

class RepFertBiz {
    private $repFertDB;

    public function __construct() {
        $this->repFertDB = new RepFertDB();
    }

    public function getFertilizaciones() {
        return $this->repFertDB->getFertilizaciones();
    }
}
?>