<?php

namespace Models;


class Carrito
{

    private static $productos = array();

    public static function save(Producto $producto)
    {
        if (!isset($_SESSION))
            session_start();
        if (isset($_SESSION['carrito']))
            Carrito::$productos = $_SESSION['carrito'];

        Carrito::$productos[] = $producto;
        $_SESSION['carrito'] = Carrito::$productos;
    }

    public static function delete($key)
    {
        if (!isset($_SESSION))
            session_start();
        if (isset($_SESSION['carrito']))
            Carrito::$productos = $_SESSION['carrito'];
        unset(Carrito::$productos[$key]);
        self::$productos = array_values(self::$productos);
        $_SESSION['carrito'] = Carrito::$productos;
    }

    public static function getAll()
    {
        if (!isset($_SESSION))
            session_start();
        if (isset($_SESSION['carrito']))
            Carrito::$productos = $_SESSION['carrito'];

        $_SESSION['Carrito'] = Carrito::$productos;

        return Carrito::$productos;
    }

    public static function getPrecioTotal()
    {
        if (!isset($_SESSION))
            session_start();
        if (isset($_SESSION['carrito']))
            Carrito::$productos = $_SESSION['carrito'];

        $precioTotal = 0;
        for ($i = 0; $i < count(self::$productos); $i++) {
            if (isset($i)) {
                if (self::$productos != null) {
                    $precioPibot = self::$productos[$i]->getPrecio() * self::$productos[$i]->getCantidad();
                    $precioTotal = $precioTotal + $precioPibot;
                }
            }
        }
        $_SESSION['Carrito'] = Carrito::$productos;

        return $precioTotal;
    }

    public static function cambiaCantidad(Producto $producto)
    {
        if (!isset($_SESSION))
            session_start();
        if (isset($_SESSION['carrito']))
            Carrito::$productos = $_SESSION['carrito'];

        for ($i = 0; $i < count(self::$productos); $i++) {
            if (self::$productos[$i]->getIdProducto() == $producto->getIdProducto()) {
                self::$productos[$i]->setCantidad($producto->getCantidad());
            }
        }
        $_SESSION['carrito'] = Carrito::$productos;
    }

    public static function precioConIva()
    {
        return self::getPrecioTotal() * 1.21;
    }

    public static function existeProducto(Producto $producto)
    {
        if (!isset($_SESSION))
            session_start();
        if (isset($_SESSION['carrito']))
            Carrito::$productos = $_SESSION['carrito'];

        $boolean = false;
        for ($i = 0; $i < count(self::$productos); $i++) {
            if (self::$productos[$i] != null && self::$productos[$i]->getIdProducto() == $producto->getIdProducto()) {
                $boolean = true;
            }
        }
        $_SESSION['carrito'] = Carrito::$productos;
        return $boolean;
    }

    public static function getProductoById(Producto $producto)
    {
        if (!isset($_SESSION))
            session_start();
        if (isset($_SESSION['carrito']))
            Carrito::$productos = $_SESSION['carrito'];

        $producto2 = null;
        for ($i = 0; $i < count(self::$productos); $i++) {
            if (self::$productos[$i] != null && self::$productos[$i]->getIdProducto() == $producto->getIdProducto()) {
                $producto2 = self::$productos[$i];
            }
        }

        $_SESSION['carrito'] = Carrito::$productos;
        return $producto2;
    }

    public static function deleteAll()
    {
        if (!isset($_SESSION))
            session_start();
        if (isset($_SESSION['carrito']))
            Carrito::$productos = $_SESSION['carrito'];

        $_SESSION['carrito'] = null;
        $_SESSION['carrito'] = array();

        $_SESSION['Carrito'] = Carrito::$productos;
    }
}
