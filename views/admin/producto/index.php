<main>
    <h2 class="titulo">Lista de Productos</h2>
    
    <div class="opciones">
        <a class="boton-opcion" href="/administrarProducto"> Listar Todos</a>
        <a class="boton-opcion" href="/producto/agregar">Agregar Nuevo Producto</a>
        <!-- <a class="boton-opcion" href="/medida">Unidades de Medidas</a> -->
        <a class="boton-opcion" href="/admin">Volver</a>
    </div>

    <form  method="POST" class="buscar">
        <div class="campoBuscar">
            <label for="codigo">Buscar por Id</label>
            <input type="text" id="codigo" name="codigo">
        </div>        

        <input class="boton-comun" type="submit" value="Buscar">
    </form>

    <?php
    if($producto !=null ){
        $unidad = $producto->devolverUnidad();
    ?>
    <div class="card">
            <!-- Apartado izquierdo con imagen y nombre de la producto -->
            <div class="left">
                <!-- <img src="ruta_de_la_imagen" alt="Nombre de la producto" style="width:100%"> -->
                <img src="/imagenes/<?php echo $producto->imagen ?> " alt="imagen de la casa" class="imagen-tabla">
            </div>

            <!-- Apartado derecho con características de la producto -->
            <div class="right">
                <p class="property-name"><span>Codigo: </span><?php echo $producto->codigo ?></p>
                <p class="property-name"><span>Nombre: </span><?php echo $producto->nombre ?></p>
                <p class="property-name"><span>Precio: </span><?php echo $producto->precio ?></p>
                <p class="property-name"><span>Stock: </span> <?php echo $producto->stock ?> </p>
                <p class="property-name"><span>Medida: </span> 
                    <?php echo (isset($unidad)) ? $unidad->descripcion : "" ?>
                </p>
                <p class="property-name"><span>Cedula Administrador: </span> <?php echo $producto->cedulaAdministrador ?> </p>
                <!-- Agrega más características aquí según sea necesario -->
            </div>

            <div class="card__opciones">
                <form method="post" class="w-100" action="/producto/eliminar">
                    <input type="hidden" name="codigo" value="<?php echo $producto->codigo ?>">
                    <input type="hidden" name="tipo" value="producto">
                    <input type="submit" class="boton-eliminar" value="Eliminar">
                </form>
                <a href="/producto/actualizar?codigo=<?php echo $producto->codigo?>" class="boton-actualizar">Actualizar</a>
            </div>
        </div>
    <?php } ?>
<?php
    
    
    foreach ($productos as $producto) {
        $unidad = $producto->devolverUnidad();
    ?>
   <div class="card">
            <!-- Apartado izquierdo con imagen y nombre de la producto -->
            <div class="left">
                <img src="/imagenes/<?php echo $producto->imagen ?> " alt="imagen de la casa" class="imagen-tabla">
            </div>

            <!-- Apartado derecho con características de la producto -->
            <div class="right">
                <p class="property-name"><span>Codigo: </span><?php echo $producto->codigo ?></p>
                <p class="property-name"><span>Nombre: </span><?php echo $producto->nombre ?></p>
                <p class="property-name"><span>Precio: </span><?php echo $producto->precio ?></p>
                <p><span>Stock: </span> <?php echo $producto->stock ?> </p>
                <p><span>Medida: </span> <?php echo (isset($unidad)) ? $unidad->descripcion : "" ?></p>
                <p><span>Cedula Administrador:</span> <?php echo $producto->cedulaAdministrador ?> </p>
                <!-- Agrega más características aquí según sea necesario -->
            </div>

            <div class="card__opciones">
                <form 
                    method="post" class="w-100" 
                    action="/producto/eliminar" 
                    id="formEliminarProducto-<?php echo $producto->codigo?>">

                    <input type="hidden" name="codigo" value="<?php echo $producto->codigo ?>">
                    <input type="hidden" name="tipo" value="producto">
                    <input 
                        type="submit" 
                        class="boton-eliminar" 
                        value="Eliminar"
                        onclick="confirmDelete(event, 'formEliminarProducto-<?php echo $producto->codigo; ?>')")"
                        >
                </form>
                <a href="/producto/actualizar?codigo=<?php echo $producto->codigo?>" class="boton-actualizar">Actualizar</a>
            </div>
        </div>
    <?php } ?>
    

</main>


<?php 
$script = "
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script src='/build/js/alertas.js'></script>
    <script src='https://kit.fontawesome.com/d74a8aa5fa.js' crossorigin='anonymous'></script>
";
?>