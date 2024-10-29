<?php

require_once '../../app/Config/Database.php';

class MaterialRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM materiales");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM materiales WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($material) {
        $stmt = $this->db->prepare("INSERT INTO materiales (descripcion) VALUES (:descripcion)");
        $stmt->bindParam(':descripcion', $material->descripcion);
        return $stmt->execute();
    }

    public function update($material) {
        $stmt = $this->db->prepare("UPDATE materiales SET descripcion = :descripcion WHERE id = :id");
        $stmt->bindParam(':id', $material->id);
        $stmt->bindParam(':descripcion', $material->descripcion);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM materiales WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
