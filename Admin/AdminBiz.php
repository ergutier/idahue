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
            $tables[] = $row[0];
        }
        return $tables;
    }
}
?>
