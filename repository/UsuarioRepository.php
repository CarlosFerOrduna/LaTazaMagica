<?php

namespace Repository;

use Core\Db;
use Models\Usuario;

class UsuarioRepository
{

    public static function getAll()
    {
        $listaUsuarios = [];
        $db = Db::getConnect();
        $stmt = $db->query('SELECT * FROM usuarios ORDER BY id_usuario');

        foreach ($stmt->fetchAll() as $usuario) {
            $listaUsuarios[] = new Usuario($usuario['id_usuario'], $usuario['username'], $usuario['email'], $usuario['password'], $usuario['isAdmin']);
        }

        return $listaUsuarios;
    }

    public static function save(Usuario $usuario)
    {

        $db = Db::getConnect();
        $insert = $db->prepare('INSERT INTO usuarios VALUES(:id_usuario,:nombre,:email,:password,:isAdmin)');
        $insert->bindValue('id_usuario', $usuario->getIdUsuario());
        $insert->bindValue('nombre', $usuario->getNombre());
        $insert->bindValue('email', $usuario->getEmail());
        $insert->bindValue('password', $usuario->getPassword());
        $insert->bindValue('isAdmin', $usuario->getIsAdmin());
        $insert->execute();
    }


    public static function update(Usuario $usuario)
    {
        $db = Db::getConnect();
        $update = $db->prepare('UPDATE usuarios SET username=:nombre, email=:email, password=:password WHERE id_usuario=:id_usuario');
        $update->bindValue('id_usuario', $usuario->getIdUsuario());
        $update->bindValue('nombre', $usuario->getNombre());
        $update->bindValue('email', $usuario->getEmail());
        $update->bindValue('password', $usuario->getPassword());
        $update->execute();
    }

    public static function delete($id_usuario)
    {
        $db = Db::getConnect();
        $delete = $db->prepare('DELETE FROM usuarios WHERE id_usuario=:id_usuario');
        $delete->bindValue('id_usuario', $id_usuario);
        $delete->execute();
    }

    public static function getById($id_usuario)
    {
        $db = Db::getConnect();
        $select = $db->prepare('SELECT * FROM usuarios WHERE id_usuario=:id_usuario');
        $select->bindValue('id_usuario', $id_usuario);
        $select->execute();

        $usuarioDb = $select->fetch();
        return new Usuario($usuarioDb['id_usuario'], $usuarioDb['username'], $usuarioDb['email'], $usuarioDb['password'], $usuarioDb['isAdmin']);
    }

    public static function login($email, $password)
    {

        $db = Db::getConnect();
        $select = $db->prepare('SELECT * FROM usuarios WHERE email=:email');
        $select->bindValue('email', $email);
        $select->execute();

        $usuarioDb = $select->fetch();

        if (password_verify($password, $usuarioDb['password'])) {
            return new Usuario($usuarioDb['id_usuario'], $usuarioDb['username'], $usuarioDb['email'], $usuarioDb['password'], $usuarioDb['isAdmin']);
        } else {
            return null;
        }

    }

    public static function getByEmail($email)
    {
        $db = Db::getConnect();
        $select = $db->prepare('SELECT * FROM usuarios WHERE email=:email');
        $select->bindValue('email', $email);
        $select->execute();

        $usuarioDb = $select->fetch();
        return new Usuario($usuarioDb['id_usuario'], $usuarioDb['username'], $usuarioDb['email'], $usuarioDb['password'], $usuarioDb['isAdmin']);
    }

    public static function existsEmail($emailNuevo)
    {
        $resultado = true;
        $db = Db::getConnect();
        $select = $db->prepare('select email from usuarios');
        $select->execute();

        $emails = $select->fetchAll();
        foreach ($emails as $email) {
            if ($email['email'] == $emailNuevo) {
                $resultado = false;
            }
        }
        return $resultado;
    }

}