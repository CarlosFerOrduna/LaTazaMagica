<div class="p-4">
    <div class="container">
        <h1 id="titulo">Sign in</h1>
    </div>
    <?php if (!empty($error)) {
        echo '<h2>' . $error . '</h2>';
    }
    ?>
</div>
<div class="container py-4">
    <form action="<?php echo BASE_URL; ?>/usuarios/agregar" method="post">
        <div class="form-group py-2">
            <label for="username">Nombre de usuario</label>
            <input type="text" name="username" class="form-control" placeholder="Nombre de Usuario">
        </div>
        <div class="form-group py-2">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="example@example.com">
        </div>
        <div class="form-group py-2">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control" placeholder="********">
        </div>
        <div class="form-group py-2">
            <input type="submit" value="enviar" name="enviar" class="btn btn-primary" id="botonSC">
        </div>
    </form>
    <a href="<?php echo BASE_URL; ?>/usuarios/login" class="btn btn-primary" id="botonSC">Loguearse</a>
</div>