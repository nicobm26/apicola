<main>
    <h2 class="titulo">Administración de unidades de medida</h2>
    
    <div class="opciones">
        <a class="boton-opcion" href="/medida"> Listar Todos</a>
        <a class="boton-opcion" href="/medida/agregar">Agregar Nueva Medida</a>
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
    // debuguear($unidad);
      include_once __DIR__ . '/../../templates/alertas.php';

    if(!$unidad == null) { ?>
    <div class="cardMedida">
            <!-- Apartado izquierdo con imagen y nombre de la producto -->
            <div >
                <p class="property-name"><span>Codigo: </span><?php echo $unidad->codigo ?></p>
                <p class="property-name"><span>Nombre: </span><?php echo $unidad->descripcion ?></p>
                <p class="property-name"><span>Precio: </span><?php echo $unidad->abreviatura ?></p>
            </div>

            <div class="card__opcionesMedida">
                <form method="post" class="w-100" action="/medida/eliminar">
                    <input type="hidden" name="codigo" value="<?php echo $unidad->codigo ?>">
                    <input type="hidden" name="tipo" value="producto">
                    <input type="submit" class="boton-eliminar"  value="Eliminar">
                    <a href="/medida/actualizar?codigo=<?php echo $unidad->codigo?>" class="boton-actualizar">Actualizar</a>
                </form>
               
            </div>
        </div>
    <?php } ?>
<?php
    
    
    foreach ($unidades as $unidad) {
        ?>
   <div class="cardMedida">
            <!-- Apartado derecho con características de la producto -->
            <div >
                <p class="property-name"><span>Codigo: </span><?php echo $unidad->codigo ?></p>
                <p class="property-name"><span>Nombre: </span><?php echo $unidad->descripcion ?></p>
                <p class="property-name"><span>Abreviatura: </span><?php echo $unidad->abreviatura ?></p>
            </div>

            <div class="card__opcionesMedida">
                <form method="post" class="w-100" action="/medida/eliminar"
                 id="formEliminarMedida-<?php echo $unidad->codigo?>"
                 >
                    <input type="hidden" name="codigo" value="<?php echo $unidad->codigo ?>">
                    <input 
                        type="submit" 
                        class="boton-eliminar" 
                        value="Eliminar"
                        onclick="confirmDelete(event, 'formEliminarMedida-<?php echo $unidad->codigo; ?>')")"
                        >
                    <!-- <input type="submit" class="boton-actualizar" formaction="/medida/actualizar" value="Actualizar"> -->
                    <a href="/medida/actualizar?codigo=<?php echo $unidad->codigo?>" class="boton-actualizar">Actualizar</a>
                </form>
                <!-- <a href="/medida/actualizar?codigo=<?php echo $unidad->codigo?>" class="boton-actualizar">Actualizar</a> -->
            </div>
        </div>
    <?php } 
    ?>
</main>

<?php
$script = "
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script src='/build/js/alertas.js'></script>
    <script src='https://kit.fontawesome.com/d74a8aa5fa.js' crossorigin='anonymous'></script>
";
?>


