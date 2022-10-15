<?php

namespace controllers;

use Models\Carrito;
use models\Producto;
use Render;
use Repository\ProductoRepository;

class ProductosController
{

    public function index()
    {

        Render::html('Views\AdminLayout', 'productos\index', ['productos' => ProductoRepository::getAll()]);
    }

    public function agregar()
    {

        if (!$_POST) {

            require_once("views/productos/agregar.php");
            Render::html('Views\AdminLayout', 'productos\agregar', []);

        } else {

            $permitidos = array("image/jpeg", "image/png", "image/gif", "image/jpg");

            $limite = 700;

            if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite * 1024 * 3) {

                $imagen = date('is') . $_FILES['imagen']['name'];

                $ruta = "public/uploads/" . $imagen;

                if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {

                    die("No se pudo cargar el archivo");
                }
                $productos = new Producto(null, $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['stock'], $imagen);

                ProductoRepository::save($productos);

                header("Location: " . BASE_URL . "/admin/productos");

            } else {

                die("Archivo no permitido");
            }

        }
    }

    public function eliminar($id)
    {

        ProductoRepository::delete($id);
        header("Location: " . BASE_URL . "/admin/productos");
    }

    public function editar($id)
    {
        $producto = ProductoRepository::getById($id);

        if (!$_POST) {

            Render::html('Views\AdminLayout', 'productos\editar', ['producto' => $producto]);
        } else {
            $producto = new Producto($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['stock'], $producto->getImagen());

            ProductoRepository::update($producto);

            header("Location: " . BASE_URL . "/admin");
        }
    }


    public static function grilla()
    {
        $titulo = "Nuestros Productos";
        $like = null;
        $productoNoEncontrado = null;

        if (isset($_POST['buscador']) && !empty($_POST['buscador'])) {

            $like = $_POST['buscador'];

            if (ProductoRepository::getByName($like) == null) {

                $productos = ProductoRepository::getAll();

                $productoNoEncontrado = '<h1>Producto no encontrado</h1>';

            } else {

                $productos = ProductoRepository::getByName($like);
            }
        } else {

            $productos = ProductoRepository::getAll();

        }

        Render::html('Views\Layout', 'productos/grilla', ['productos' => $productos, 'palabraBuscador' => $like, 'productoNoEncontrado' => $productoNoEncontrado, 'titulo' => $titulo]);
    }


    public function detalle($id)
    {
        $producto = ProductoRepository::getById($id);

        if (Carrito::existeProducto($producto)) {

            $producto = Carrito::getProductoById($producto);

            $views = 'productos/detalleProductoEnCarrito';

        } elseif ($producto->getStock() == 0) {

            $views = 'productos/detalleStockCero';

        } else {

            $views = 'productos/detalle';
        }


        Render::html('Views\Layout', $views, ['producto' => $producto]);
    }


}
