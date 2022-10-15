<div class="row">
    <div class="col-6">
        <img src="<?php echo BASE_URL; ?>/public/uploads/<?= $producto->getImagen(); ?>" class="card-img-top" alt="...">
    </div>
    <div class="col-6">
        <h1><?php echo $producto->getNombre(); ?></h1>
        <p><?php echo $producto->getDescripcion(); ?></p>
        <h2>$<?php echo $producto->getPrecio(); ?></h2>
        <p>Stock disponible: <?php echo $producto->getStock(); ?></p>
        <form action="<?php echo BASE_URL ?>/carrito/agregar" method="post">
            <input type="number" name="cantidad" value="1" min="1"
                   max="<?php echo $producto->getStock(); ?>">
            <input type="hidden" name="id" value="<?php echo $producto->getIdProducto() ?>">
            <br>
            <input type="submit" name="enviar" value="Agregar al carrito" id="botonAgregarCarrito">
        </form>
    </div>
</div>