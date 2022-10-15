<?php

use Core\Auth;
use Core\Autoload;
use Core\Router;

$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off") ? "https" : "http");
$base_url .= "://" . $_SERVER['HTTP_HOST'];
$base_url .= dirname($_SERVER['SCRIPT_NAME']);

define('BASE_URL', $base_url);
define('BASE_DIR', dirname($_SERVER['SCRIPT_NAME']) . "/");

require_once("./core/autoload.php");
Autoload::exec();

$router = new Router();


//productos


$router->get('', function () {
    (new controllers\ProductosController())->grilla();
});

$router->post('', function () {
    (new controllers\ProductosController())->grilla();
});

$router->get('productos', function () {
    (new controllers\ProductosController())->grilla();
});

$router->post('productos', function () {
    (new controllers\ProductosController())->grilla();
});

$router->get('productos/detalle/{id}', function ($params) {
    (new controllers\ProductosController)->detalle($params['id']);
});


//carrito


$router->get('carrito', function () {
    Auth::redirectIsAdmin();
    (new controllers\CarritoController())->index();
});

$router->post('carrito/agregar', function () {
    Auth::redirectIsAdmin();
    (new controllers\CarritoController())->agregar();
});

$router->post('carrito/eliminar', function () {
    Auth::redirectIsAdmin();
    (new controllers\CarritoController())->eliminar();
});

$router->get('carrito/editar/{id}', function ($params) {
    Auth::redirectIsAdmin();
    (new controllers\CarritoController())->editar($params['id']);
});

$router->get('carrito/checkout', function () {
    Auth::redirectIsAdmin();
    (new controllers\OrdenCompraController())->index();
});

$router->get('carrito/ordencompra', function () {
    Auth::redirectIsAdmin();
    (new controllers\CarritoController())->index();
});

$router->post('carrito/ordencompra', function () {
    Auth::redirectIsAdmin();
    (new controllers\OrdenCompraController())->agregar();
});

$router->get('carrito/vaciar', function () {
    Auth::redirectIsAdmin();
    (new controllers\CarritoController())->vaciar();
});


// cliente orden de compra


$router->get('ordencompra/misordenes', function () {
    (new controllers\OrdenCompraController())->getAllByUser();
});

$router->get('ordencompra/ordencompra/{id}', function ($params) {
    (new controllers\OrdenCompraController())->getOrdenById($params['id']);
});


// Admin productos


$router->get('admin', function () {
    Auth::check();
    Auth::checkIsAdmin();
    (new controllers\ProductosController)->index();
});

$router->get('admin/productos', function () {
    Auth::check();
    Auth::checkIsAdmin();
    (new controllers\ProductosController())->index();
});

$router->get('admin/productos/eliminar/{id}', function ($params) {
    Auth::check();
    Auth::checkIsAdmin();
    (new controllers\ProductosController())->eliminar($params['id']);
});

$router->get('admin/productos/agregar', function () {
    Auth::check();
    Auth::checkIsAdmin();
    (new controllers\ProductosController())->agregar();
});

$router->post('admin/productos/agregar', function () {
    Auth::check();
    Auth::checkIsAdmin();
    (new controllers\ProductosController())->agregar();
});

$router->get('admin/productos/editar/{id}', function ($params) {
    Auth::check();
    Auth::checkIsAdmin();
    (new controllers\ProductosController())->editar($params['id']);
});

$router->post('admin/productos/editar/{id}', function ($params) {
    Auth::check();
    Auth::checkIsAdmin();
    (new controllers\ProductosController())->editar($params['id']);
});


// admin usuarios


$router->get('admin/usuarios', function () {
    Auth::check();
    Auth::checkIsAdmin();
    (new controllers\UsuarioController)->index();
});

$router->get('admin/usuarios/eliminar/{id}', function ($params) {
    Auth::check();
    Auth::checkIsAdmin();
    (new controllers\UsuarioController)->eliminar($params['id']);
});


// admin orden de compra


$router->get('admin/ordenescompra', function () {
    Auth::check();
    Auth::checkIsAdmin();
    (new controllers\OrdenCompraController())->getAll();
});

$router->get('admin/ordencompra/editar/{id}', function ($params) {
    Auth::check();
    Auth::checkIsAdmin();
    (new controllers\OrdenCompraController())->editar($params['id']);
});

$router->post('admin/ordencompra/editar/{id}', function ($params) {
    Auth::check();
    Auth::checkIsAdmin();
    (new controllers\OrdenCompraController())->editar($params['id']);
});


// usuarios


$router->post('usuarios/login', function () {
    Auth::check();
    (new controllers\UsuarioController)->login();
});

$router->get('usuarios/login', function () {
    (new controllers\UsuarioController)->login();
});

$router->post('usuarios/logout', function () {
    Auth::check();
    (new controllers\UsuarioController)->logout();
});

$router->get('usuarios/logout', function () {
    Auth::check();
    (new controllers\UsuarioController)->logout();
});

$router->get('usuarios/agregar', function () {
    (new controllers\UsuarioController)->agregar();
});

$router->post('usuarios/agregar', function () {
    Auth::check();
    (new controllers\UsuarioController)->agregar();
});

$router->get('usuarios/panelusuario/', function () {
    Auth::check();
    (new controllers\UsuarioController)->panel();
});

$router->post('usuarios/panelusuario/', function () {
    Auth::check();
    (new controllers\UsuarioController)->panel();
});

$router->get('usuarios/editar/{id}', function ($params) {
    Auth::check();
    (new controllers\UsuarioController)->editar($params['id']);
});


//Por default

$router->notFound(function () {
    require_once("./views/404.php");
});


$router->run();
