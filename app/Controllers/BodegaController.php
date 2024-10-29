<?php

require_once '../../app/Repository/BodegaRepository.php';
require_once '../../app/Models/Bodega.php';

class BodegaController {
    private $bodegaRepository;

    public function __construct() {
        $this->bodegaRepository = new BodegaRepository();
    }

    public function index() {
        $bodegas = $this->bodegaRepository->getAll();
        header('Content-Type: application/json');
        echo json_encode($bodegas);
    }

    public function show($id) {
        $bodega = $this->bodegaRepository->getById($id);
        if ($bodega) {
            header('Content-Type: application/json');
            echo json_encode($bodega);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Bodega no encontrada']);
        }
    }

    public function create() {
        $data = json_decode(file_get_contents('php://input'));
        $bodega = new Bodega(null, $data->descripcion);
        if ($this->bodegaRepository->create($bodega)) {
            http_response_code(201);
            echo json_encode(['message' => 'Bodega creada']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Error al crear la bodega']);
        }
    }

    public function update($id) {
        $data = json_decode(file_get_contents('php://input'));
        $bodega = new Bodega($id, $data->descripcion);
        if ($this->bodegaRepository->update($bodega)) {
            echo json_encode(['message' => 'Bodega actualizada']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Error al actualizar la bodega']);
        }
    }

    public function delete($id) {
        if ($this->bodegaRepository->delete($id)) {
            echo json_encode(['message' => 'Bodega eliminada']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Error al eliminar la bodega']);
        }
    }
}
