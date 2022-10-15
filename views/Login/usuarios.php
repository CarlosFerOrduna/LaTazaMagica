<div class="container py-4">
    <table class="table" id="myTable">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Es Admin</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($usuarios as $usuario) {
            ?>
            <tr>
                <td><?php echo $usuario->getIdUsuario(); ?></td>
                <td><?php echo $usuario->getNombre(); ?></td>
                <td><?php echo $usuario->getEmail(); ?></td>
                <td><?php echo $usuario->getIsAdmin(); ?></td>
                <td>
                <td>
                    <a href="<?php echo BASE_URL; ?>/admin/usuarios/eliminar/<?php echo $usuario->getIdUsuario(); ?>"
                       class="btn btn-primary"
                       id="botonEliminar">
                        <span class="material-symbols-outlined">
                            delete
                        </span>
                        Eliminar
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <a href="<?php echo BASE_URL; ?>/usuarios/agregar" class="btn btn-primary" id="botonEliminar">
        <span class="material-symbols-outlined">person_add</span>
        Agregar usuario</a>
</div>