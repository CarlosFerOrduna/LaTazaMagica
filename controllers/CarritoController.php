<?php

namespace controllers;

use Core\Auth;
use Models\Carrito;
use Render;
use Repository\ProductoRepository;

class CarritoController
{


    public function boton()
    {
        if (!Auth::isAdmin()) {
            $productos = count(Carrito::getAll());
            require_once("./views/Carrito/boton.php");
        }
    }

    public function index()
    {
        $productos = Carrito::getAll();

        Render::html('Views\Layout', 'carrito/index', ['productos' => $productos]);
    }

    public function agregar()
    {
        if (isset($_POST['enviar']) && !Auth::isAdmin()) {

            $nuevaCantidad = $_POST['cantidad'];

            if ($nuevaCantidad != 0) {

                $id = $_POST['id'];

                $producto = ProductoRepository::getById($id);

                $producto->setCantidad($nuevaCantidad);

                if (Carrito::existeProducto($producto)) {

                    Carrito::cambiaCantidad($producto);
                } else {

                    Carrito::save($producto);
                }
                Render::html('Views\Layout', 'carrito/index', ['productos' => Carrito::getAll()]);
            }
        }
    }

    public function editar($id)
    {
        $producto = ProductoRepository::getById($id);
        $producto = Carrito::getProductoById($producto);

        Render::html('Views\Layout', 'productos/detalleProductoEnCarrito', ['producto' => $producto]);
    }

    public function eliminar()
    {
        if (isset($_POST['eliminar'])) {

            $id = $_POST['key'];

            Carrito::delete($id);

            header("Location: " . BASE_URL . "/carrito");
        }
    }

    public function vaciar()
    {
        Carrito::deleteAll();

        $productos = Carrito::getAll();

        Render::html('Views\Layout', 'carrito/index', ['productos' => $productos]);
    }
}

