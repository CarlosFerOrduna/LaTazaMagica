<h2><?php echo $usuario->getNombre() ?></h2>
<p><?php echo $usuario->getEmail() ?></p>
<table class="table" id="myTable">
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Usuario</th>
        <th>Direccion</th>
        <th>Provincia</th>
        <th>Codigo Postal</th>
        <!--        <th>Total a Pagar</th>-->
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>

    <?php
    foreach ($ordenes as $key => $orden) {
        ?>
        <tr>
            <td><?php echo $orden->getFecha(); ?></td>
            <td><?php echo $orden->getUsuario()->getEmail(); ?></td>
            <td><?php echo $orden->getDireccion(); ?></td>
            <td><?php echo $orden->getProvincia(); ?></td>
            <td><?php echo $orden->getCodigoPostal(); ?></td>
            <!--            <td>--><?php //echo $ordene->(); ?><!--</td>-->
            <td><?php echo $orden->getEstado(); ?></td>
            <td><a href="<?php echo BASE_URL ?>/ordencompra/ordencompra/<?php echo $orden->getIdOrden() ?>"
                   class="btn btn-primary" id="botonSC">
                    <span class="material-symbols-outlined">
                        search
                    </span>
                    Ver
                </a>
            </td>
        </tr>
        <?php
    }

    ?>
    </tbody>
</table>
