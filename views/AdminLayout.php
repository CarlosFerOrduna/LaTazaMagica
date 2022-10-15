<?php

namespace Views;

use controllers\UsuarioController;

class AdminLayout
{

    public function __construct()
    {

        ?>
        <!-- Content-->
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
                  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
                  crossorigin="anonymous">
            <link rel="stylesheet"
                  href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
            <link href="<?php echo BASE_URL; ?>/public/styles.css" rel="stylesheet">
            <title>La Taza Animada</title>
        </head>
        <body>

        <div class="sidenav">
            <?php
            (new UsuarioController)->botonesSidebar();
            ?>
            <a href="<?php echo BASE_DIR; ?>">
                <span class="material-symbols-outlined">home</span>
                Inicio
            </a>
            <?php
            (new UsuarioController)->botonLogout();
            ?>
        </div>
        <div class="container py-4">
        <?php
    }

    public function __destruct()
    {
        ?>
        </div>
        </body>
        </html>
        <?php
    }
}

?>