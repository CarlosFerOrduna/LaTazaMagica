<div class="p-4 text-white">
    <div class="container">
        <h1 id="titulo">Lista de Productos</h1>
    </div>
</div>


<div class="container py-4">
    <table class="table" id="myTable">
        <a href="<?php echo BASE_URL; ?>/admin/productos/agregar" class="btn btn-primary" id="botonAgregarCarrito">
        <span class="material-symbols-outlined">
            add
        </span>
            Agregar
        </a>

        <thead>
        <tr>
            <th>id</th>
            <th>imagen</th>
            <th>nombre</th>
            <th>descripcion</th>
            <th>precio</th>
            <th>stock</th>
            <th>acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($productos as $producto) {
            ?>
            <tr>
                <td><?php echo $producto->getIdProducto(); ?></td>
                <td><img src="<?php echo BASE_URL ?>/public/uploads/<?php echo $producto->getImagen(); ?>" width="50"
                         alt="foto">
                </td>
                <td><?php echo $producto->getNombre(); ?></td>
                <td><?php echo $producto->getDescripcion(); ?></td>
                <td><?php echo $producto->getPrecio(); ?></td>
                <?php
                if ($producto->getStock() == 0) {
                    ?>
                    <td style="color: crimson"><?php echo $producto->getStock(); ?></td>
                    <?php
                } else {
                    ?>
                    <td><?php echo $producto->getStock(); ?></td>
                    <?php

                }
                ?>
                <td>
                    <a href="<?php echo BASE_URL; ?>/admin/productos/eliminar/<?php echo $producto->getIdProducto(); ?>"
                       class="btn btn-primary"
                       id="botonEliminar">
                        <span class="material-symbols-outlined">
                            delete
                        </span>
                        Eliminar
                    </a>
                    <a href="<?php echo BASE_URL; ?>/admin/productos/editar/<?php echo $producto->getIdProducto(); ?>"
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