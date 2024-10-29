<?php

class Sucursal {
    public $id;
    public $bodega_id;
    public $descripcion;

    public function __construct($id, $bodega_id, $descripcion) {
        $this->id = $id;
        $this->bodega_id = $bodega_id;
        $this->descripcion = $descripcion;
    }
}
