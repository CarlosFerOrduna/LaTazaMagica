<?php


namespace Models;


class OrdenCompra
{

    private $id_orden;
    private $usuario;
    private $nombre;
    private $apellido;
    private $telefono;
    private $direccion;
    private $provincia;
    private $codigoPostal;
    private $productos;
    private $estado;
    private $fecha;


    public function __construct($id_orden, $usuario, $nombre, $apellido, $telefono, $direccion, $provincia, $codigoPostal, $productos, $estado, $fecha)
    {
        $this->id_orden = $id_orden;
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->provincia = $provincia;
        $this->codigoPostal = $codigoPostal;
        $this->productos = $productos;
        $this->estado = $estado;
        $this->fecha = $fecha;
    }

    public function getIdOrden()
    {
        return $this->id_orden;
    }

    public function setIdOrden($id_orden)
    {
        $this->id_orden = $id_orden;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function getProvincia()
    {
        return $this->provincia;
    }

    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;
    }

    public function getProductos()
    {
        return $this->productos;
    }

    public function setProductos(array $productos)
    {
        $this->productos = $productos;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
}
