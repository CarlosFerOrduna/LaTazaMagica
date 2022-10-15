<div class="p-4 text-white">
    <div class="container">
        <h1 id="titulo">Agregar Producto</h1>
    </div>
</div>


<div class="container py-4">

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group py-2">
            <label for="imagen" class="control-label">Imagen</label>
            <input class="form-control" name="imagen" id="imagen" type="file" required>
        </div>


        <div class="form-group py-2">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" minlength="5">
        </div>
        <div class="form-group py-2">
            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Descripcion">
        </div>
        <div class="form-group py-2">
            <label for="precio">Precio</label>
            <input type="text" name="precio" class="form-control" id="precio" placeholder="Precio">
        </div>
        <div class="form-group py-2">
            <label for="stock">stock</label>
            <input type="text" name="stock" class="form-control" id="stock" placeholder="stock">
        </div>

        <div class="py-2">
            <button type="submit" class="btn btn-primary" id="botonSC">Guardar</button>
        </div>

    </form>

</div>