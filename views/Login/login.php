<div class="p-4 text-white">
    <div class="container">
        <h1 id="titulo">Login</h1>
    </div>
</div>
<div class="container py-4">
    <form action="<?php echo BASE_URL; ?>/usuarios/login" method="post">
        <div class="form-group py-2">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="form-group py-2">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group py-2">
            <input type="submit" value="Enviar" name="enviar" class="btn btn-primary" id="botonSC">        
        </div>
    </form>
    <a href="<?php echo BASE_URL; ?>/usuarios/agregar" class="btn btn-primary" id="botonSC">
        <span class="material-symbols-outlined">
            person_add
        </span>
        Crear usuario
    </a>
</div>