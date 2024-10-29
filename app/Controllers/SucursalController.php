<?php

require_once '../../app/Repository/SucursalRepository.php';
require_once '../../app/Models/Bodega.php';

class SucursalController {
    private $sucursalRepository;

    public function __construct() {
        $this->sucursalRepository = new SucursalRepository();
    }

    public function index() {
        $sucursales = $this->sucursalRepository->getAll();
        header('Content-Type: application/json');
        echo json_encode($sucursales);
    }

    public function getAllByBodegaId($bodegaId) {
        $sucursales = $this->sucursalRepository->getAllByBodegaId($bodegaId);
        header('Content-Type: application/json');
        echo json_encode($sucursales);
    }

    public function show($id) {
        $sucursal = $this->sucursalRepository->getById($id);
        if ($sucursal) {
            header('Content-Type: application/json');
            echo json_encode($sucursal);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Sucursal no encontrada']);
        }
    }

    public function create() {
        $data = json_decode(file_get_contents('php://input'));
        $sucursal = new Sucursal(null, $data->bodega_id, $data->descripcion);
        if ($this->sucursalRepository->create($sucursal)) {
            http_response_code(201);
            echo json_encode(['message' => 'Sucursal creada']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Error al crear la sucursal']);
        }
    }

    public function update($id) {
        $data = json_decode(file_get_contents('php://input'));
        $sucursal = new Sucursal($id, $data->bodega_id, $data->descripcion);
        if ($this->sucursalRepository->update($sucursal)) {
            echo json_encode(['message' => 'Sucursal actualizada']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Error al actualizar la sucursal']);
        }
    }

    public function delete($id) {
        if ($this->sucursalRepository->delete($id)) {
            echo json_encode(['message' => 'Sucursal eliminada']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Error al eliminar la sucursal']);
        }
    }
}
