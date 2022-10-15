<h1 id="titulo"><?php echo $titulo; ?></h1>
<?php
if (!empty($productoNoEncontrado)) {
    echo $productoNoEncontrado;
}

if (!empty($palabraBuscador)) {
    echo '<h1>Usted acaba de buscar: ' . $palabraBuscador . '</h1>';
}


?>
<form action="" method="post" id="buscador">
    <label for="buscador">Buscar</label>
    <label>
        <input type="text" name="buscador">
    </label><br>
</form>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">

    <?php

    foreach ($productos as $producto) {
        ?>
        <div class="col">
            <div class="card">
                <img src="public/uploads/<?= $producto->getImagen(); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title "><?php echo $producto->getNombre(); ?></h5>
                    <p class="card-text"><?php echo $producto->getDescripcion(); ?></p>
                    <p class="card-text"
                       style="color: red"><?php if ($producto->getStock() == 0) echo 'Producto sin stock' ?></p>
                    <a href="./productos/detalle/<?php echo $producto->getIdProducto(); ?>"
                       class="stretched-link">$<?php echo $producto->getPrecio(); ?></a>
                </div>
            </div>

        </div>
        <?php

    }
    ?>

</div>