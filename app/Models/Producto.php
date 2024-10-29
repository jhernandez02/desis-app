<?php

class Producto {
    public $id;
    public $sucursal_id;
    public $moneda_id;
    public $codigo;
    public $nombre;
    public $precio;
    public $descripcion;
    public $materiales;

    public function __construct($id, $sucursal_id, $moneda_id, $codigo, $nombre, $precio, $descripcion, $materiales) {
        $this->id = $id;
        $this->sucursal_id = $sucursal_id;
        $this->moneda_id = $moneda_id;
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->materiales = $materiales;
    }
}
