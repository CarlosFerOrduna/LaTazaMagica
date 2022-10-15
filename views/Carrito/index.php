<div class="row">
    <div class="col-10">
        <h2 id="Carrito">Carrito de compras</h2>
    </div>
    <div class="col-2">
        <a href="<?php echo BASE_URL ?>/carrito/vaciar" class="btn btn-primary" id="botonSC">Vaciar carrito</a>
    </div>
    <div class="col-12">
        <table class="table" id="myTable">
            <thead>
            <tr>
                <th>nombre</th>
                <th>imagen</th>
                <th>descripcion</th>
                <th>cantidad</th>
                <th>precio</th>
                <th>acciones</th>
            </tr>
            </thead>
            <tbody>

            <?php

            use Models\Carrito;

            foreach ($productos as $key => $producto) {

                $nuevoStock = $producto->getStock() + $producto->getCantidad();
                ?>
                <tr>
                    <td><?php echo $producto->getNombre(); ?></td>
                    <td><img alt="fotoProducto"
                             src="<?php echo BASE_URL; ?>/public/uploads/<?php echo $producto->getImagen(); ?>"
                             width="50">
                    </td>
                    <td><?php echo $producto->getDescripcion(); ?></td>
                    <td><?php echo $producto->getCantidad(); ?></td>
                    <td><?php echo $producto->getPrecio(); ?></td>
                    <td>

                        <form action="<?php echo BASE_URL ?>/carrito/eliminar" method="post">
                            <input type="hidden" name="nuevoStock" value="<?php echo $nuevoStock; ?>">
                            <input type="hidden" name="key" value="<?php echo $key; ?>">
                            <input type="submit" value="Eliminar" name="eliminar" id="botonEliminar">
                        </form>
                    </td>
                    <td><a href="<?php echo BASE_URL ?>/carrito/editar/<?php echo $producto->getIdProducto(); ?>"
                           class="btn btn-primary"
                           id="botonSC">Editar</a></td>
                </tr>
                <?php
            }

            ?>
            </tbody>
            <tbody>
            <td>Precio total</td>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo '$ ' ?><?php echo Carrito::getPrecioTotal(); ?></td>
            </tbody>
            <tbody>
            <td>Precio subtotal</td>
            <td></td>
            <td></td>
            <td><?php echo 'IVA 21%'; ?></td>
            <td><?php echo '$ ' ?><?php echo Carrito::getPrecioTotal() * 0.21; ?></td>
            </tbody>
            <tbody>
            <td>Precio final</td>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo '$ ' ?><?php echo Carrito::precioConIva() ?></td>

            <td><a href="<?php echo BASE_URL; ?>/carrito/checkout" class="btn btn-primary" id="botonEliminar">Finalizar
                    compra</a></td>
            <td><a href="<?php echo BASE_DIR; ?>" class="btn btn-primary" id="botonSC">Seguir comprando</a></td>

        </table>
    </div>
</div>