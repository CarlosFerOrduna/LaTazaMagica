<?php

namespace Repository;

use Core\Auth;
use Core\Db;
use Models\OrdenCompra;
use Models\OrdenProducto;
use Models\Producto;

class OrdenCompraRepository
{

    public static function save(OrdenCompra $ordenCompra)
    {
        $db = Db::getConnect();
        $insert = $db->prepare('insert into `orden_compra` values(:id_orden_compra,:id_usuario,:nombre,:apellido,:telefono,:direccion,:provincia,:codigoPostal,:estado,now())');
        $insert->bindValue('id_orden_compra', $ordenCompra->getIdOrden());
        $insert->bindValue('id_usuario', $ordenCompra->getUsuario()->getIdUsuario());
        $insert->bindValue('nombre', $ordenCompra->getNombre());
        $insert->bindValue('apellido', $ordenCompra->getApellido());
        $insert->bindValue('telefono', $ordenCompra->getTelefono());
        $insert->bindValue('direccion', $ordenCompra->getDireccion());
        $insert->bindValue('provincia', $ordenCompra->getProvincia());
        $insert->bindValue('codigoPostal', $ordenCompra->getCodigoPostal());
        $insert->bindValue('estado', $ordenCompra->getEstado());

        $insert->execute();

        $nuevaOrden = self::getById(self::lastInsertId());

        foreach ($ordenCompra->getProductos() as $item) {
            OrdenProductoRepository::save(new OrdenProducto(null, $nuevaOrden->getIdOrden(), $item->getIdProducto(), $item->getCantidad()));
        }

        return $nuevaOrden;
    }

    public static function getByUsuarioActual()
    {
        $resultSet = array();
        $usuario = UsuarioRepository::getByEmail(Auth::getUser()->getEmail());
        $db = Db::getConnect();
        $query = $db->prepare('select * from orden_compra where id_usuario = :id_usuario');
        $query->bindValue('id_usuario', $usuario->getIdUsuario());
        $query->execute();

        foreach ($query->fetchAll() as $join) {
            $resultSet [] = new OrdenCompra
            (
                $join['id_orden_compra'],
                UsuarioRepository::getById($join['id_usuario']),
                $join['nombre'],
                $join['apellido'],
                $join['telefono'],
                $join['direccion'],
                $join['provincia'],
                $join['codigo_postal'],
                self::getProductosByIdOrden($join['id_orden_compra']),
                $join['estado'],
                $join['fecha']
            );
        }
        return $resultSet;
    }

    public static function getById($id)
    {
        $db = Db::getConnect();
        $query = $db->prepare('select * from orden_compra where id_orden_compra = :id');
        $query->bindValue('id', $id);
        $query->execute();

        $join = $query->fetch();
        return new OrdenCompra
        (
            $join['id_orden_compra'],
            UsuarioRepository::getById($join['id_usuario']),
            $join['nombre'],
            $join['apellido'],
            $join['telefono'],
            $join['direccion'],
            $join['provincia'],
            $join['codigo_postal'],
            self::getProductosByIdOrden($join['id_orden_compra']),
            $join['estado'],
            $join['fecha']
        );
    }

    public static function getAll()
    {
        $listaOrdenCompra = [];
        $db = Db::getConnect();
        $query = $db->query('SELECT * FROM orden_compra ORDER BY estado');

        foreach ($query->fetchAll() as $ordenCompra) {
            $listaOrdenCompra[] = new OrdenCompra($ordenCompra['id_orden_compra'],
                UsuarioRepository::getById($ordenCompra['id_usuario']),
                $ordenCompra['nombre'],
                $ordenCompra['apellido'],
                $ordenCompra['telefono'],
                $ordenCompra['direccion'],
                $ordenCompra['provincia'],
                $ordenCompra['codigo_postal'],
                OrdenProductoRepository::getBy('id_orden_compra', $ordenCompra['id_orden_compra']),
                $ordenCompra['estado'],
                $ordenCompra['fecha']);
        }
        return $listaOrdenCompra;
    }

    public static function update(OrdenCompra $ordenCompra)
    {
        $db = Db::getConnect();
        $update = $db->prepare
        ('UPDATE  orden_compra SET id_usuario=:id_usuario, nombre=:nombre, apellido=:apellido, telefono=:telefono, direccion=:direccion, provincia=:provincia, codigo_postal=:codigo_postal, estado=:estado, fecha=:fecha WHERE id_orden_compra=:id_orden_compra');
        $update->bindValue('id_orden_compra', $ordenCompra->getIdOrden());
        $update->bindValue('id_usuario', $ordenCompra->getUsuario()->getIdUsuario());
        $update->bindValue('nombre', $ordenCompra->getNombre());
        $update->bindValue('apellido', $ordenCompra->getApellido());
        $update->bindValue('telefono', $ordenCompra->getTelefono());
        $update->bindValue('direccion', $ordenCompra->getDireccion());
        $update->bindValue('provincia', $ordenCompra->getProvincia());
        $update->bindValue('codigo_postal', $ordenCompra->getCodigoPostal());
        $update->bindValue('estado', $ordenCompra->getEstado());
        $update->bindValue('fecha', $ordenCompra->getFecha());
        $update->execute();
    }

    public static function delete($id_orden_compra)
    {
        $db = Db::getConnect();
        $delete = $db->prepare('delete orden_compra, op
                                      from orden_compra
                                      inner join orden_producto op on orden_compra.id_orden_compra = op.id_orden_compra
                                      inner join productos p on op.id_producto = p.id_producto
                                      where op.id_orden_compra = :id');
        $delete->bindValue('id_orden_compra', $id_orden_compra);
        $delete->execute();
    }

    public static function getProductosByIdOrden($id)
    {
        $db = Db::getConnect();
        $select = $db->prepare('select p.id_producto, p.nombre, p.descripcion, p.precio, p.stock, p.imagen, op.cantidad
                                      from orden_compra
                                      inner join orden_producto op on orden_compra.id_orden_compra = op.id_orden_compra
                                      inner join productos p on op.id_producto = p.id_producto
                                      where op.id_orden_compra = :id');
        $select->bindValue('id', $id);
        $select->execute();

        $listaProductos = array();

        foreach ($select->fetchAll() as $key => $producto) {
            $listaProductos[] = new Producto($producto['id_producto'], $producto['nombre'], $producto['descripcion'], $producto['precio'], $producto['stock'], $producto['imagen']);
            $listaProductos[$key]->setCantidad($producto['cantidad']);
        }

        return $listaProductos;
    }


    public static function lastInsertId()
    {
        $db = Db::getConnect();
        $query = $db->prepare('select max(id_orden_compra) from orden_compra where id_usuario = :usuario');
        $query->execute(['usuario' => UsuarioRepository::getByEmail(Auth::getUser()->getEmail())->getIdUsuario()]);
        $id = $query->fetch();
        return $id[0];
    }

}