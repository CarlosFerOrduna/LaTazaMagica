<div class="row">
    <div class="col-6">
        <h2>Orden de compra</h2>
        <ul>
            <li>Fecha: <?php echo $orden->getFecha(); ?></li>
            <li>Usuario: <?php echo $orden->getUsuario()->getEmail(); ?></li>
            <li>Direccion: <?php echo $orden->getDireccion(); ?></li>
            <li>Provincia: <?php echo $orden->getProvincia(); ?></li>
            <li>CP: <?php echo $orden->getCodigoPostal(); ?></li>
            <li>Estado Actual: <?php echo $orden->getEstado(); ?></li>
        </ul>
    </div>
    <div class="col-6">
        <form action="<?php echo BASE_URL; ?>/admin/ordencompra/editar/<?php echo $orden->getIdOrden(); ?>" method="post">
            <label for="" class="form-label">Cambiar estado</label>
            <select name="nuevoEstado" id="nuevoEstado" class="form-select my-2">
                <option value="en_proceso">EN PROCESO</option>
                <option value="entregada">ENTREGADA</option>
                <option value="despachada">DESPACHADA</option>
                <option value="cancelada">CANCELADA</option>
            </select>
            <input type="submit" name="cambiar" value="Cambiar estado" class="form-control my-2" id="botonSC">
        </form>
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
