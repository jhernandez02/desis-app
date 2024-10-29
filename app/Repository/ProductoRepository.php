<?php

require_once '../../app/Config/Database.php';

class ProductoRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $sql = "SELECT p.*, m.descripcion AS moneda, s.descripcion AS sucursal, b.descripcion AS bodega, GROUP_CONCAT(t.descripcion) AS materiales
                FROM productos p 
                INNER JOIN monedas m ON m.id=p.moneda_id 
                INNER JOIN sucursales s ON s.id=p.sucursal_id 
                INNER JOIN bodegas b ON b.id=s.bodega_id 
                INNER JOIN material_productos mp ON mp.producto_id=p.id 
                INNER JOIN materiales t ON t.id=mp.material_id
                GROUP BY p.id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByCodigo($codigo) {
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE codigo = :codigo");
        $stmt->bindParam(':codigo', $codigo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($producto) {
        $stmt = $this->db->prepare("INSERT INTO productos (sucursal_id, moneda_id, codigo, nombre, precio, descripcion) VALUES (:sucursal_id, :moneda_id, :codigo, :nombre, :precio, :descripcion)");
        $stmt->bindParam(':sucursal_id', $producto->sucursal_id);
        $stmt->bindParam(':moneda_id', $producto->moneda_id);
        $stmt->bindParam(':codigo', $producto->codigo);
        $stmt->bindParam(':nombre', $producto->nombre);
        $stmt->bindParam(':precio', $producto->precio);
        $stmt->bindParam(':descripcion', $producto->descripcion);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function createMaterialProducto($producto_id, $material_id){
        $stmt = $this->db->prepare("INSERT INTO material_productos (material_id, producto_id) VALUES (:material_id, :producto_id)");
        $stmt->bindParam(':material_id', $material_id);
        $stmt->bindParam(':producto_id', $producto_id);
        return $stmt->execute();
    }

    public function update($producto) {
        $stmt = $this->db->prepare("UPDATE productos SET sucursal_id = :sucursal_id, moneda_id = :moneda_id, codigo = :codigo, nombre = :nombre, precio = :precio, descripcion = :descripcion WHERE id = :id");
        $stmt->bindParam(':id', $producto->id);
        $stmt->bindParam(':sucursal_id', $producto->sucursal_id);
        $stmt->bindParam(':moneda_id', $producto->moneda_id);
        $stmt->bindParam(':codigo', $producto->codigo);
        $stmt->bindParam(':nombre', $producto->nombre);
        $stmt->bindParam(':precio', $producto->precio);
        $stmt->bindParam(':descripcion', $producto->descripcion);
        $stmt->bindParam(':fecha_creacion', $producto->fecha_creacion);
        $stmt->bindParam(':estado', $producto->estado);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
