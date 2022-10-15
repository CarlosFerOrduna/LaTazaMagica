<?php

namespace Core;

use http\Header;
use Models\Usuario;

class Auth
{

    public static function login(Usuario $usuario)
    {
        if (!isset($_SESSION))
            session_start();
        $_SESSION['auth'] = $usuario;
    }


    public static function logout()
    {
        if (!isset($_SESSION))
            session_start();
        unset($_SESSION['auth']);
    }

    public static function check()
    {
        if (!isset($_SESSION))
            session_start();
        if (!isset($_SESSION['auth'])) {
            header("Location: " . BASE_URL . "/usuarios/login");
        }
    }

    public static function checkIsAdmin()
    {
        if (!self::isAdmin()) {
            header("Location: " . BASE_URL . "/usuarios/panelusuario/");
        }
    }

    public static function getUser()
    {
        if (!isset($_SESSION))
            session_start();
        if (!isset($_SESSION['auth'])) {
            return null;
        } else {
            return $_SESSION['auth'];
        }
    }

    public static function isAdmin()
    {
        if (empty(self::getUser()) || self::getUser()->getIsAdmin() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function redirectIsAdmin()
    {
        if (self::isAdmin()) {
            header("Location: " . BASE_URL);
        }
    }
}
