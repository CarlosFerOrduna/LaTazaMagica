<h2>Finalizar compra</h2>
<div class="row">
    <div class="col-8">
        <?php
        if (empty($usuario)){ ?>
            <p class="iniciar"><b>Iniciá sesión o registrate para continuar</b></p>
            <a href="<?php echo BASE_URL; ?>/usuarios/login" class="btn btn-primary" id="botonSC">Login</a>
        <?php } else { ?>
    </div>
    <p class="nombre"><?php echo $usuario->getNombre(); ?></p>
    <?php if (!empty($error)) {
        echo '<h2 style="color: #82e7c8;text-shadow: 0 0 2px black;">' . $error . '</h2>';
    }
    ?>
    <h4 class="mb-3">Datos de envío</h4>
    <div class="col-8">
        <form action="<?php echo BASE_URL ?>/carrito/ordencompra" method="post">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre">
                </div>
                <div class="col-sm-6">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" name="apellido" id="apellido">
                </div>
                <div class="col-12">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" name="direccion" id="direccion">
                </div>
                <div class="col-12">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" name="telefono" id="telefono">
                </div>
                <div class="col-md-5">
                    <label for="provincia" class="form-label">Provincia</label>
                    <select class="form-select" name="provincia" id="provincia">
                        <option value="CABA">CABA</option>
                        <option value="Córdoba">Córdoba</option>
                        <option value="San Luis">San Luis</option>
                        <option value="Mendoza">Mendoza</option>
                        <option value="Corrientes">Corrientes</option>
                        <option value="Salta">Salta</option>
                        <option value="Rio Negro">Rio Negro</option>
                        <option value="Neuquén">Neuquén</option>
                        <option value="Chubut">Chubut</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="codigoPostal" class="form-label">Código Postal</label>
                    <input type="text" class="form-control" name="codigoPostal" id="codigoPostal">
                </div>
            </div>
            <hr class="my-4">
            <input type="submit" value="Realizar Operación" name="enviar" class="col-12 btn btn-primary" id="botonSC">
        </form>
    </div>
    <div class="col-4">
        <table>
            <thead>
            <tr>
                <th scope="col">Producto</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            <?php
            foreach ($productos as $key => $producto) {
                ?>
                <tr class="td-tabla">
                    <td><?php echo $producto->getIdProducto(); ?></td>
                    <td><?php echo $producto->getNombre(); ?></td>
                    <td><?php echo '$ ' ?><?php echo $producto->getPrecio(); ?></td>
                </tr>

                <?php
            }
            ?>

            <tr class="total-pagar">
                <th scope="row"></th>
                <td><b> Total a pagar</b></td>
                <td><b><?php echo '$ ' ?><?php echo $total ?></b></td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php } ?>
</div>
