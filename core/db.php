<?php


namespace Core;

use PDO;
use PDOException;

class Db
{

    public static function getConnect()
    {
        try {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            return new PDO('mysql:host=localhost;dbname=mvc', 'root', '', $pdo_options);
        } catch (PDOException $e) {

            require_once("./views/404.php");

            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
