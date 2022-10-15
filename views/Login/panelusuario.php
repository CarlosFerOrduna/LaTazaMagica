<div class="p-4 text-white">
    <div class="container">
        <h1 id="titulo">Panel Usuario</h1>
    </div>
</div>
<div class="container py-4">
    <form action="<?php echo BASE_URL ?>/usuarios/panelusuario/" method="POST">
        <div>
            <input type="hidden" name="id" value="<?php echo $usuario->getIdUsuario(); ?>">
        </div>
        <div class="form-group py-2">
            <p>Nombre</p>
            <p class="form-control"><?php echo $usuario->getNombre(); ?></p>
        </div>
        <div class="form-group py-2">
            <p>Email</p>
            <p class="form-control"><?php echo $usuario->getEmail(); ?></p>
        </div>
        <div class="form-group py-2">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control" id="password"
                   placeholder="Ingrese una nueva contraseña" min="3" required>
        </div>
        <div class="py-2">
            <button type="submit" name="enviar" class="btn btn-primary" id="botonSC">
                <span class="material-symbols-outlined">
                    save
                </span>
                Guardar
            </button>
        </div>
    </form>
</div>