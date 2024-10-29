<?php

require_once '../../app/Config/Routes.php';

require_once '../../app/Controllers/ProductoController.php';
require_once '../../app/Controllers/BodegaController.php';
require_once '../../app/Controllers/SucursalController.php';
require_once '../../app/Controllers/MonedaController.php';
require_once '../../app/Controllers/MaterialController.php';

// Instanciar el router y definir las rutas para la API
$router = new Router();
$router->addRoute('GET', 'api/productos', 'ProductoController', 'index');
$router->addRoute('GET', 'api/productos/{id}', 'ProductoController', 'show');
$router->addRoute('GET', 'api/productos/exist/{codigo}', 'ProductoController', 'isExist');
$router->addRoute('POST', 'api/productos', 'ProductoController', 'create');
$router->addRoute('PUT', 'api/productos/{id}', 'ProductoController', 'update');
$router->addRoute('DELETE', 'api/productos/{id}', 'ProductoController', 'delete');

$router->addRoute('GET', 'api/monedas', 'MonedaController', 'index');
$router->addRoute('GET', 'api/monedas/{id}', 'MonedaController', 'show');
$router->addRoute('POST', 'api/monedas', 'MonedaController', 'create');
$router->addRoute('PUT', 'api/monedas/{id}', 'MonedaController', 'update');
$router->addRoute('DELETE', 'api/monedas/{id}', 'MonedaController', 'delete');

$router->addRoute('GET', 'api/bodegas', 'BodegaController', 'index');
$router->addRoute('GET', 'api/bodegas/{id}', 'BodegaController', 'show');
$router->addRoute('POST', 'api/bodegas', 'BodegaController', 'create');
$router->addRoute('PUT', 'api/bodegas/{id}', 'BodegaController', 'update');
$router->addRoute('DELETE', 'api/bodegas/{id}', 'BodegaController', 'delete');

$router->addRoute('GET', 'api/sucursales', 'SucursalController', 'index');
$router->addRoute('GET', 'api/sucursales/bodega/{id}', 'SucursalController', 'getAllByBodegaId');
$router->addRoute('GET', 'api/sucursales/{id}', 'SucursalController', 'show');
$router->addRoute('POST', 'api/sucursales', 'SucursalController', 'create');
$router->addRoute('PUT', 'api/sucursales/{id}', 'SucursalController', 'update');
$router->addRoute('DELETE', 'api/sucursales/{id}', 'SucursalController', 'delete');

$router->addRoute('GET', 'api/materiales', 'MaterialController', 'index');
$router->addRoute('GET', 'api/materiales/{id}', 'MaterialController', 'show');
$router->addRoute('POST', 'api/materiales', 'MaterialController', 'create');
$router->addRoute('PUT', 'api/materiales/{id}', 'MaterialController', 'update');
$router->addRoute('DELETE', 'api/materiales/{id}', 'MaterialController', 'delete');

// Resolver la ruta
$router->resolve();