<?php

namespace Models;

class OrdenProducto
{

    private $idOrdenProducto;
    private $idOrdenCompra;
    private $idProducto;
    private $cantidad;

    public function __construct($idOrdenProducto, $idOrdenCompra, $idProducto, $cantidad)
    {
        $this->idOrdenProducto = $idOrdenProducto;
        $this->idOrdenCompra = $idOrdenCompra;
        $this->idProducto = $idProducto;
        $this->cantidad = $cantidad;
    }

    public function getIdOrdenProducto()
    {
        return $this->idOrdenProducto;
    }

    public function getIdOrdenCompra()
    {
        return $this->idOrdenCompra;
    }

    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

}