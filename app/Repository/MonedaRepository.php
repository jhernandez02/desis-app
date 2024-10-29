<?php

require_once '../../app/Config/Database.php';

class MonedaRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM monedas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM monedas WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($moneda) {
        $stmt = $this->db->prepare("INSERT INTO monedas (descripcion) VALUES (:descripcion)");
        $stmt->bindParam(':descripcion', $moneda->descripcion);
        return $stmt->execute();
    }

    public function update($moneda) {
        $stmt = $this->db->prepare("UPDATE monedas SET descripcion = :descripcion WHERE id = :id");
        $stmt->bindParam(':id', $moneda->id);
        $stmt->bindParam(':descripcion', $moneda->descripcion);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM monedas WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}