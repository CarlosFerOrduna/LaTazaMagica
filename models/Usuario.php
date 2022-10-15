<?php

namespace Models;

class Usuario
{
    private $id_usuario;
    private $nombre;
    private $email;
    private $password;
    private $isAdmin;

    function __construct($id_usuario, $nombre, $email, $password, $isAdmin)
    {
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

}
