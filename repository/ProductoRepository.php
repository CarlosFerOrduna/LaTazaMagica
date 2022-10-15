<?php

namespace Repository;


use Core\Db;
use Models\Producto;

class ProductoRepository
{
    public static function getAll()
    {
        $listaProductos = [];
        $db = Db::getConnect();
        $stmt = $db->query('SELECT * FROM productos ORDER BY id_producto');

        foreach ($stmt->fetchAll() as $producto) {
            $listaProductos[] = new Producto($producto['id_producto'], $producto['nombre'], $producto['descripcion'], $producto['precio'], $producto['stock'], $producto['imagen']);
        }

        return $listaProductos;
    }

    public static function getByName($parameter)
    {
        $listaProductos = [];
        $db = Db::getConnect();
        $stmt = $db->prepare('select * from productos where nombre like ?');
        $like = ["%$parameter%"];
        $stmt->execute($like);

        foreach ($stmt->fetchAll() as $producto) {
            $listaProductos[] = new Producto($producto['id_producto'], $producto['nombre'], $producto['descripcion'], $producto['precio'], $producto['stock'], $producto['imagen']);
        }

        return $listaProductos;
    }

    public static function save(Producto $producto)
    {
        $db = Db::getConnect();
        $insert = $db->prepare('INSERT INTO productos VALUES(:id_producto,:nombre,:descripcion,:precio,:stock,:imagen)');
        $insert->execute(['id_producto' => $producto->getIdProducto(), 'nombre' => $producto->getNombre(), 'descripcion' => $producto->getDescripcion(), 'precio' => $producto->getPrecio(), 'stock' => $producto->getStock(), 'imagen' => $producto->getImagen()]);
    }


    public static function update(Producto $producto)
    {
        $db = Db::getConnect();
        $update = $db->prepare('UPDATE productos SET nombre=:nombre, descripcion=:descripcion, precio=:precio, stock=:stock, imagen=:imagen WHERE id_producto=:id_producto');
        $update->bindValue('id_producto', $producto->getIdProducto());
        $update->bindValue('nombre', $producto->getNombre());
        $update->bindValue('descripcion', $producto->getDescripcion());
        $update->bindValue('precio', $producto->getPrecio());
        $update->bindValue('stock', $producto->getStock());
        $update->bindValue('imagen', $producto->getImagen());
        $update->execute();
    }

    public static function updateStock(Producto $producto)
    {
        $db = Db::getConnect();
        $update = $db->prepare('UPDATE productos SET stock=:nuevoStock WHERE id_producto=:id');
        $update->execute(['nuevoStock' => ($producto->getStock() - $producto->getCantidad()), 'id' => $producto->getIdProducto()]);
    }

    public static function delete($id_producto)
    {
        $db = Db::getConnect();
        $delete = $db->prepare('DELETE FROM productos WHERE id_producto=:id_producto');
        $delete->bindValue('id_producto', $id_producto);
        $delete->execute();
    }


    public static function getById($id_producto)
    {
        $db = Db::getConnect();
        $select = $db->prepare('SELECT * FROM productos WHERE id_producto=:id_producto');
        $select->bindValue('id_producto', $id_producto);
        $select->execute();

        $productoDb = $select->fetch();
        return new producto($productoDb['id_producto'], $productoDb['nombre'], $productoDb['descripcion'], $productoDb['precio'], $productoDb['stock'], $productoDb['imagen']);
    }

//    public static function selectStock($id_producto)
//    {
//        $db = Db::getConnect();
//        $select = $db->prepare('SELECT stock FROM productos WHERE id_producto=:id_producto');
//        $select->execute(['id_producto' => $id_producto]);
//        return $select->fetch();
//    }

}