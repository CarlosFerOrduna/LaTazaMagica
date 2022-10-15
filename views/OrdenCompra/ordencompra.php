<div class="row">
    <div class="col-4">
        <h2>Orden de compra</h2>
        <ul>
            <li>Fecha: <?php echo $orden->getFecha(); ?></li>
            <li>Usuario: <?php echo $orden->getUsuario()->getEmail(); ?></li>
            <li>Direccion: <?php echo $orden->getDireccion(); ?></li>
            <li>Provincia: <?php echo $orden->getProvincia(); ?></li>
            <li>CP: <?php echo $orden->getCodigoPostal(); ?></li>
            <li>Estado: <?php echo $orden->getEstado(); ?></li>
        </ul>
    </div>

    <table class="table" id="myTable">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Precio</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($productos as $key => $producto) {
            ?>
            <tr>
                <td><?php echo $producto->getNombre(); ?></td>
                <td><img alt="fotoProducto"
                         src="<?php echo BASE_URL; ?>/public/uploads/<?php echo $producto->getImagen(); ?>" width="50">
                </td>
                <td><?php echo $producto->getDescripcion(); ?></td>
                <td><?php echo $producto->getCantidad(); ?></td>
                <td><?php echo $producto->getPrecio(); ?></td>
            </tr>
            <?php
        }

        ?>
        </tbody>
    </table>
</div>
