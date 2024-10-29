<?php

class Bodega {
    public $id;
    public $descripcion;

    public function __construct($id, $descripcion) {
        $this->id = $id;
        $this->descripcion = $descripcion;
    }
}
