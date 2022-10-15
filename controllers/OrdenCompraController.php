<?php

namespace controllers;

use Core\Auth;
use Models\Carrito;
use Models\OrdenCompra;
use Render;
use Repository\OrdenCompraRepository;
use Repository\OrdenProductoRepository;
use Repository\ProductoRepository;
use Repository\UsuarioRepository;

class OrdenCompraController
{
    public function index()
    {
        if (!empty(Carrito::getAll())) {
            $usuario = Auth::getUser();
            $productos = Carrito::getAll();
            $total = Carrito::precioConIva();

            Render::html('Views\Layout', 'ordencompra/checkout', ['productos' => $productos, 'usuario' => $usuario, 'total' => $total]);
        } else {
            header("Location: " . BASE_URL . "/carrito");
        }
    }

    public static function agregar()
    {
        $productos = Carrito::getAll();
        if (isset($_POST)) {
            if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['telefono']) &&
                !empty($_POST['direccion']) && !empty($_POST['provincia']) && !empty($_POST['codigoPostal'])) {
                if (is_numeric($_POST['telefono'])) {
                    $ordenCompra = new OrdenCompra
                    (
                        null,
                        UsuarioRepository::getByEmail(Auth::getUser()->getEmail()),
                        $_POST['nombre'],
                        $_POST['apellido'],
                        $_POST['telefono'],
                        $_POST['direccion'],
                        $_POST['provincia'],
                        $_POST['codigoPostal'],
                        $productos,
                        'en_proceso',
                        null
                    );

                    OrdenCompraRepository::save($ordenCompra);

                    foreach ($productos as $producto) {
                        ProductoRepository::updateStock($producto);
                    }

                    $orden = OrdenCompraRepository::getById(OrdenCompraRepository::lastInsertId());

                    Carrito::deleteAll();

                    Render::html('Views\Layout', 'ordencompra/ordencompra', ['orden' => $orden, 'productos' => $productos]);
                } else {
                    $error = 'El teléfono debe ser un número';
                    $usuario = Auth::getUser();
                    $productos = Carrito::getAll();
                    $total = Carrito::precioConIva();

                    Render::html('Views\Layout', 'ordencompra/checkout', ['productos' => $productos, 'usuario' => $usuario, 'total' => $total, 'error' => $error]);

                }
            } else {
                $usuario = Auth::getUser();
                $productos = Carrito::getAll();
                $total = Carrito::precioConIva();
                $error = 'Debes completar todos los campos';

                Render::html('Views\Layout', 'ordencompra/checkout', ['productos' => $productos, 'usuario' => $usuario, 'total' => $total, 'error' => $error]);

            }
        }
    }

    public static function getAllByUser()
    {
        $usuario = Auth::getUser();
        $ordenes = OrdenCompraRepository::getByUsuarioActual();

        Render::html('Views\AdminLayout', 'ordencompra/misordenes', ['ordenes' => $ordenes, 'usuario' => $usuario]);
    }

    public static function getOrdenById($id)
    {
        $orden = null;
        $usuario = Auth::getUser();
        if (!empty(OrdenCompraRepository::getById($id))) {
            $orden = OrdenCompraRepository::getById($id);
        }

        Render::html('Views\AdminLayout', 'ordencompra/miorden', ['orden' => $orden, 'usuario' => $usuario, 'productos' => $orden->getProductos()]);
    }

    public function getAll()
    {
        $ordenes = array();
        if (!empty(OrdenCompraRepository::getAll())) {
            $ordenes = OrdenCompraRepository::getAll();
        }

        Render::html('Views\AdminLayout', 'ordencompra/ordenes', ['ordenes' => $ordenes]);
    }

    public function editar($id)
    {
        $orden = null;
        if (!empty(OrdenCompraRepository::getById($id))) {
            $orden = OrdenCompraRepository::getById($id);
            if (isset($_POST['cambiar'])) {
                $orden->setEstado($_POST['nuevoEstado']);
                OrdenCompraRepository::update($orden);
            }
        }

        Render::html('Views\AdminLayout', 'ordencompra/ordenadmin', ['orden' => $orden, 'productos' => $orden->getProductos()]);
    }

}