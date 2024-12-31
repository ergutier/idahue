<?php
include_once 'database.php';

class Mantenedor {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read($table) {
        $query = "SELECT * FROM " . $table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        $query = "INSERT INTO " . $table . " (" . $columns . ") VALUES (" . $values . ")";
        $stmt = $this->conn->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":" . $key, htmlspecialchars(strip_tags($value)));
        }

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($table, $data, $id) {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= $key . " = :" . $key . ", ";
        }
        $set = rtrim($set, ", ");
        $query = "UPDATE " . $table . " SET " . $set . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":" . $key, htmlspecialchars(strip_tags($value)));
        }
        $stmt->bindValue(":id", htmlspecialchars(strip_tags($id)));

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($table, $id) {
        $query = "DELETE FROM " . $table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id", htmlspecialchars(strip_tags($id)));

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
