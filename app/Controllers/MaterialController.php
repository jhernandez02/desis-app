<?php

require_once '../../app/Repository/MaterialRepository.php';
require_once '../../app/Models/Material.php';

class MaterialController {
    private $materialRepository;

    public function __construct() {
        $this->materialRepository = new MaterialRepository();
    }

    public function index() {
        $materiales = $this->materialRepository->getAll();
        header('Content-Type: application/json');
        echo json_encode($materiales);
    }

    public function show($id) {
        $material = $this->materialRepository->getById($id);
        if ($material) {
            header('Content-Type: application/json');
            echo json_encode($material);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Material no encontrado']);
        }
    }

    public function create() {
        $data = json_decode(file_get_contents('php://input'));
        $material = new Material(null, $data->descripcion);
        if ($this->materialRepository->create($material)) {
            http_response_code(201);
            echo json_encode(['message' => 'Material creado']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Error al crear el material']);
        }
    }

    public function update($id) {
        $data = json_decode(file_get_contents('php://input'));
        $material = new Material($id, $data->material);
        if ($this->materialRepository->update($material)) {
            echo json_encode(['message' => 'Material actualizada']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Error al actualizar el material']);
        }
    }

    public function delete($id) {
        if ($this->materialRepository->delete($id)) {
            echo json_encode(['message' => 'Material eliminada']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Error al eliminar el material']);
        }
    }
}
