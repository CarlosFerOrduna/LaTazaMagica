<?php

namespace Views;


use controllers\CarritoController;
use controllers\UsuarioController;

class Layout
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
            <link href="<?php echo BASE_DIR; ?>/public/styles.css" rel="stylesheet">
            <title>La Taza Animada</title>
        </head>

        <body>


        <div id="Navbar1" class="contenedor ">
            <div id="Navbar" class="container">

                <?php
                (new CarritoController)->boton();
                (new UsuarioController)->boton();
                ?>

                <h1><a id="LTA" href="<?php echo BASE_DIR; ?>">La Taza Animada</a></h1>
                <a id="Logo" title="Logo" href="<?php echo BASE_DIR; ?>"><img
                            src="<?php echo BASE_URL; ?>/public/uploads/LTA.jpg" alt="Logo"/></a>


            </div>
        </div>


        <div class="container py-4">


        <?php

    }


    public function __destruct()
    {
        ?>

        </div>

        <footer class="bg-light text-center">

            <!-- Copyright -->
            <div id="foot" class="text-center p-3">
                Produccion Web 2022
            </div>
            <!-- Copyright -->
        </footer>


        </body>

        </html>
        <?php
    }
}

?>