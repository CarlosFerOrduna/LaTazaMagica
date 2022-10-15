<?php

namespace Repository;

use Core\Db;
use Models\OrdenProducto;

class OrdenProductoRepository
{

    public static function getBy($column, $value)
    {
        $resultSet = null;

        $db = Db::getConnect();
        $query = $db->query("select * from orden_producto inner join productos on orden_producto.id_producto = productos.id_producto where $column = '$value'");

        foreach ($query->fetchAll() as $join) {
            $resultSet = new OrdenProducto($join['id_orden_producto'], $join['id_orden_compra'], ProductoRepository::getById($join['id_producto']), $join['cantidad']);
        }
        return $resultSet;
    }

    public static function save(OrdenProducto $item)
    {
        $db = Db::getConnect();
        $query = $db->prepare('insert into orden_producto values (:id_orden_producto, :id_orden_compra, :id_producto, :cantidad)');
        $query->bindValue('id_orden_producto', $item->getIdOrdenProducto());
        $query->bindValue('id_orden_compra', $item->getIdOrdenCompra());
        $query->bindValue('id_producto', $item->getIdProducto());
        $query->bindValue('cantidad', $item->getCantidad());

        $query->execute();

        return self::getById(self::lastInsertId());
    }

    public static function getById($idOrdenProducto)
    {
        $db = Db::getConnect();
        $select = $db->prepare('SELECT * FROM orden_producto WHERE id_orden_producto=:id_orden_producto');
        $select->bindValue('id_orden_producto', $idOrdenProducto);
        $select->execute();

        $ordenProducto = $select->fetch();
        return new OrdenProducto($ordenProducto['id_orden_producto'], $ordenProducto['id_orden_compra'], $ordenProducto['id_producto'], $ordenProducto['cantidad']);
    }

    public static function getAll()
    {
        $listaOrdenProducto = [];
        $db = Db::getConnect();
        $query = $db->query('SELECT * FROM orden_producto ORDER BY id_orden_producto');

        foreach ($query->fetchAll() as $ordenProducto) {
            $listaOrdenProducto[] = new OrdenProducto($ordenProducto['id_orden_producto'], $ordenProducto['id_orden_compra'], $ordenProducto['id_producto'], $ordenProducto['cantidad']);
        }
        return $listaOrdenProducto;
    }

    public static function update(OrdenProducto $ordenProducto)
    {
        $db = Db::getConnect();
        $update = $db->prepare('UPDATE  orden_producto SET id_orden_compra=:id_orden_compra, id_producto=:id_producto, cantidad=:cantidad WHERE id_orden_producto=:id_orden_producto');
        $update->bindValue('id_orden_producto', $ordenProducto->getIdOrdenProducto());
        $update->bindValue('id_orden_compra', $ordenProducto->getIdOrdenCompra());
        $update->bindValue('id_producto', $ordenProducto->getIdProducto());
        $update->bindValue('cantidad', $ordenProducto->getCantidad());
        $update->execute();
    }

    public static function delete($id_orden_producto)
    {
        $db = Db::getConnect();
        $delete = $db->prepare('DELETE FROM orden_producto WHERE id_orden_producto=:id_orden_producto');
        $delete->bindValue('id_orden_producto', $id_orden_producto);
        $delete->execute();
    }

    public static function lastInsertId()
    {
        $db = Db::getConnect();
        $query = $db->prepare('select max(id_orden_producto) from orden_producto where id_orden_compra = :id_orden_compra');
        $query->execute(['id_orden_compra' => OrdenCompraRepository::lastInsertId()]);
        $id = $query->fetch();
        return $id[0];
    }

}