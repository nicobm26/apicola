<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\LoginController;
use MVC\Router;
use Controllers\PaginasController;
use Controllers\ComprarController;
use Controllers\MedidaController;

$router = new Router();

// Zona publica
//Paginas publicas de los visitantes
$router->get("/", [PaginasController::class, 'index']); //dominio (/)
$router->get("/nosotros", [PaginasController::class, 'nosotros']);
$router->get("/productos", [PaginasController::class, 'productos']);
$router->get("/producto", [PaginasController::class, 'producto']);
$router->post("/producto", [PaginasController::class, 'producto']);

$router->get("/contactanos", [PaginasController::class, 'contactanos']);
$router->post("/contactanos", [PaginasController::class, 'contactanos']);

$router->get("/comprar", [ComprarController::class, 'comprar']);
$router->post("/comprar", [ComprarController::class, 'comprar']);

$router->get("/carrito", [ComprarController::class, 'carrito']);
$router->post("/carrito", [ComprarController::class, 'carrito']);


//Panel administracion
// $router->get("/admin", [::class, 'contactanos']);
// $router->post("/contactanos", [PaginasController::class, 'contactanos']);


//Login y Autenticacion
$router->get("/login", [LoginController::class, 'login']);
$router->post("/login", [LoginController::class, 'login']);
$router->get("/registrar", [LoginController::class, 'registrar']);
$router->post("/registrar", [LoginController::class, 'registrar']);
$router->get("/logout", [LoginController::class, 'logout']);

// Recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

//Login admin
$router->get("/loginAdmin", [LoginController::class, 'loginAdministrador']);
$router->post("/loginAdmin", [LoginController::class, 'loginAdministrador']);

//Panel de administracion
$router->get("/admin", [AdminController::class, 'index']);
$router->post("/admin", [AdminController::class, 'index']);
$router->get("/administrarProducto", [AdminController::class, 'producto']);
$router->post("/administrarProducto", [AdminController::class, 'producto']);
$router->get("/producto/agregar", [AdminController::class, 'agregarProducto']);
$router->post("/producto/agregar", [AdminController::class, 'agregarProducto']);
$router->get("/producto/actualizar", [AdminController::class, 'actualizarProducto']);
$router->post("/producto/actualizar", [AdminController::class, 'actualizarProducto']);
$router->post("/producto/eliminar", [AdminController::class, 'eliminarProducto']);

$router->get("/medida", [MedidaController::class, 'index']);
$router->post("/medida", [MedidaController::class, 'index']);
$router->get("/medida/agregar", [MedidaController::class, 'agregarMedida']);
$router->post("/medida/agregar", [MedidaController::class, 'agregarMedida']);
$router->get("/medida/actualizar", [MedidaController::class, 'actualizarMedida']);
$router->post("/medida/actualizar", [MedidaController::class, 'actualizarMedida']);
$router->post("/medida/eliminar", [MedidaController::class, 'eliminarMedida']);
// $router->get("/crearAdmin", [AdminController::class, 'crearAdmin']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();

?>