<?php

namespace Core;
class Autoload
{

    public static function exec()
    {
        spl_autoload_register(function ($class) {
            $ruta = str_replace("\\", "/", $class) . ".php";
            if (is_readable($ruta)) {
                include_once $ruta;
            }
        });
    }
}
