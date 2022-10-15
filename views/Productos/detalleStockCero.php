<div class="row">
    <div class="col-6">
        <img src="<?php

        echo BASE_URL; ?>/public/uploads/<?= $producto->getImagen(); ?>" class="card-img-top" alt="...">

    </div>

    <div class="col-6">

        <h1><?php echo $producto->getNombre(); ?></h1>
        <p><?php echo $producto->getDescripcion(); ?></p>
        <h2>$<?php echo $producto->getPrecio(); ?></h2>
        <p>Stock disponible: <?php echo $producto->getStock(); ?></p>

        <p style="color: crimson">Producto sin stock momentaneamente</p>

    </div>

</div>


