<?php

require_once '../../app/Repository/MonedaRepository.php';
require_once '../../app/Models/Moneda.php';

class MonedaController {
    private $monedaRepository;

    public function __construct() {
        $this->monedaRepository = new MonedaRepository();
    }

    public function index() {
        $monedas = $this->monedaRepository->getAll();
        header('Content-Type: application/json');
        echo json_encode($monedas);
    }

    public function show($id) {
        $moneda = $this->monedaRepository->getById($id);
        if ($moneda) {
            header('Content-Type: application/json');
            echo json_encode($moneda);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Moneda no encontrada']);
        }
    }

    public function create() {
        $data = json_decode(file_get_contents('php://input'));
        $moneda = new Moneda(null, $data->descripcion);
        if ($this->monedaRepository->create($moneda)) {
            http_response_code(201);
            echo json_encode(['message' => 'Moneda creada']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Error al crear la moneda']);
        }
    }

    public function update($id) {
        $data = json_decode(file_get_contents('php://input'));
        $moneda = new Moneda($id, $data->descripcion);
        if ($this->monedaRepository->update($moneda)) {
            echo json_encode(['message' => 'Moneda actualizada']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Error al actualizar la moneda']);
        }
    }

    public function delete($id) {
        if ($this->monedaRepository->delete($id)) {
            echo json_encode(['message' => 'Moneda eliminada']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Error al eliminar la moneda']);
        }
    }
}
