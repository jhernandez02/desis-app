<?php

require_once '../../app/Config/Database.php';

class BodegaRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM bodegas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM bodegas WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($bodega) {
        $stmt = $this->db->prepare("INSERT INTO bodegas (descripcion) VALUES (:descripcion)");
        $stmt->bindParam(':descripcion', $bodega->descripcion);
        return $stmt->execute();
    }

    public function update($bodega) {
        $stmt = $this->db->prepare("UPDATE bodegas SET descripcion = :descripcion WHERE id = :id");
        $stmt->bindParam(':id', $bodega->id);
        $stmt->bindParam(':descripcion', $bodega->descripcion);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM bodegas WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
