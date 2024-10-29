<?php

require_once '../../app/Config/Database.php';

class SucursalRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM sucursales");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllByBodegaId($bodegaId) {
        $stmt = $this->db->prepare("SELECT * FROM sucursales WHERE bodega_id= :bodega_id");
        $stmt->bindParam(':bodega_id', $bodegaId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM sucursales WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($sucursal) {
        $stmt = $this->db->prepare("INSERT INTO sucursales (bodega_id, descripcion) VALUES (:bodega_id, :descripcion)");
        $stmt->bindParam(':bodega_id', $sucursal->bodega_id);
        $stmt->bindParam(':descripcion', $sucursal->descripcion);
        return $stmt->execute();
    }

    public function update($sucursal) {
        $stmt = $this->db->prepare("UPDATE sucursales SET bodega_id = :bodega_id, descripcion = :descripcion WHERE id = :id");
        $stmt->bindParam(':id', $sucursal->id);
        $stmt->bindParam(':bodega_id', $sucursal->bodega_id);
        $stmt->bindParam(':descripcion', $sucursal->descripcion);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM sucursales WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
