<?php

namespace Models;

class Producto
{
    private $id_producto;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $imagen;
    private $cantidad;


    function __construct($id_producto, $nombre, $descripcion, $precio, $stock, $imagen)
    {
        $this->id_producto = $id_producto;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->imagen = $imagen;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getIdProducto()
    {
        return $this->id_producto;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

}
