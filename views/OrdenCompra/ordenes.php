<div class="p-4">
    <div class="container">
        <h1 id="titulo">Ordenes de Compra</h1>
    </div>
</div>
<div class="container py-4">
    <table class="table" id="myTable">
        <thead>
        <tr>
            <th>id</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Codigo Postal</th>
            <th>Estado</th>
            <th>Fecha</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($ordenes as $orden) {
            ?>
            <tr <?php
            if ($orden->getEstado() == 'en_proceso') {
                ?>
                style="background-color: #e2a17d"
                <?php
            } elseif ($orden->getEstado() == 'despachada') {
                ?>
                style="background-color: #bebfb0"
                <?php
            }
            ?>>
                <td><?php echo $orden->getIdOrden(); ?></td>
                <td><?php echo $orden->getUsuario()->getEmail(); ?></td>
                <td><?php echo $orden->getNombre(); ?></td>
                <td><?php echo $orden->getApellido(); ?></td>
                <td><?php echo $orden->getTelefono(); ?></td>
                <td><?php echo $orden->getDireccion(); ?></td>
                <td><?php echo $orden->getCodigoPostal(); ?></td>
                <td><?php echo $orden->getEstado(); ?></td>
                <td><?php echo $orden->getFecha(); ?></td>
                <td>
                    <a href="<?php echo BASE_URL; ?>/admin/ordencompra/editar/<?php echo $orden->getIdOrden(); ?>"
                       class="btn btn-primary" id="botonSC">
                        <span class="material-symbols-outlined">
                            edit
                        </span>
                        Editar
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

</div>