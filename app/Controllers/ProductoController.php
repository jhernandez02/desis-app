<?php

require_once '../../app/Repository/ProductoRepository.php';
require_once '../../app/Models/Producto.php';

class ProductoController {
    private $productoRepository;

    public function __construct() {
        $this->productoRepository = new ProductoRepository();
    }

    public function index() {
        $productos = $this->productoRepository->getAll();
        header('Content-Type: application/json');
        echo json_encode($productos);
    }

    public function show($id) {
        $producto = $this->productoRepository->getById($id);
        if ($producto) {
            header('Content-Type: application/json');
            echo json_encode($producto);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Producto no encontrado']);
        }
    }

    public function isExist($codigo){
        $producto = $this->productoRepository->getByCodigo($codigo);
        $response['message'] = $producto ? true : false;
        echo json_encode($response);
    }

    public function create() {
        $data = json_decode(file_get_contents('php://input'));
        $producto = new Producto(null, $data->sucursal_id, $data->moneda_id, $data->codigo, $data->nombre, $data->precio, $data->descripcion, $data->materiales);
        if ($producto_id=$this->productoRepository->create($producto)) {
            foreach($data->materiales as $material_id){
                $this->productoRepository->createMaterialProducto($producto_id, $material_id);
            }
            http_response_code(201);
            echo json_encode(['message' => 'Producto creado', 'status' => 'ok']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Error al crear el producto', 'status' => 'error']);
        }
    }

    public function update($id) {
        $data = json_decode(file_get_contents('php://input'));
        $producto = new Producto($id, $data->sucursal_id, $data->moneda_id, $data->codigo, $data->nombre, $data->precio, $data->descripcion, $data->materiales);
        if ($this->productoRepository->update($producto)) {
            echo json_encode(['message' => 'Producto actualizado']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Error al actualizar el producto']);
        }
    }

    public function delete($id) {
        if ($this->productoRepository->delete($id)) {
            echo json_encode(['message' => 'Producto eliminado']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Error al eliminar el producto']);
        }
    }
}
