<div class="p-4 text-white">
    <div class="container">
        <h1 id="titulo">Editar Producto</h1>
    </div>
</div>
<div class="container py-4">
    <form method="POST">
        <label for="id"></label>
        <input type="text" name="id" class="form-control" id="id" placeholder="id"
               value="<?php echo $producto->getIdProducto(); ?>" hidden>
        <div class="form-group py-2">
            <label for="name">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="name" placeholder="Nombre"
                   value="<?php echo $producto->getNombre(); ?>">
        </div>
        <div class="form-group py-2">
            <label for="exampleInputEmail1">Descripcion</label>
            <label for="descripcion"></label><input type="text" name="descripcion" class="form-control" id="descripcion"
                                                    placeholder="Descripcion"
                                                    value="<?php echo $producto->getDescripcion(); ?>">
        </div>
        <div class="form-group py-2">
            <label for="precio">Precio</label>
            <input type="text" name="precio" class="form-control" id="precio" placeholder="Precio"
                   value="<?php echo $producto->getPrecio(); ?>">
        </div>
        <div class="form-group py-2">
            <label for="stock">stock</label>
            <input type="text" name="stock" class="form-control" id="stock" placeholder="stock"
                   value="<?php echo $producto->getStock(); ?>">
        </div>
        <div class="py-2">
            <button type="submit" class="btn btn-primary" id="botonSC">
            <span class="material-symbols-outlined">
                save
            </span>
                Guardar
            </button>
        </div>
    </form>
</div>