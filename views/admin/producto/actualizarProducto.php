<h1>Actualizar producto</h1>

<div>
    <a href="/administrarProducto" class="boton">Volver</a>
</div>

<?php 
      include_once __DIR__ . '/../../templates/alertas.php';
?>

<form method="POST" class="formulario contenedorFormulario" enctype="multipart/form-data">

    <div class="campo">
        <label class="campo__name" for="codigo">Código</label>
        <input type="text" id="codigo" name="producto[codigo]" 
        value="<?php echo $producto->codigo; ?>"
        >
    </div>

    <div class="campo">
        <label class="campo__name" for="nombre">Nombre</label>
        <input type="text" id="nombre" name="producto[nombre]"
        value="<?php echo $producto->nombre; ?>"
        >
    </div>

    <div class="campo">
        <label class="campo__name" for="descripcion">Descripción</label>
        <textarea id="descripcion" name=producto[descripcion]"> <?php echo $producto->descripcion; ?>
        </textarea>  
    </div>

    <div class="campo">
        <label class="campo__name" for="precio">Precio</label>
        <input type="number" id="precio" name="producto[precio]"
        value="<?php echo $producto->precio; ?>"
        >
    </div>

    <div class="campo">
        <label class="campo__name" for="cantidad">Valor Medida</label>
        <input type="number" id="cantidad" name="producto[cantidad]"
        value="<?php echo $producto->cantidad; ?>"
        >
    </div>

    <div class="campo">
        <label class="campo__name" for="codigoMedida">Codigo de Medida</label>
        <select name="producto[codigoMedida]" id="codigoMedida">
                    <option value="">--Seleccionar--</option>
                    <?php foreach($unidadesMedidas as $unidadesMedida) : ?>
                        <option 
                            <?php echo $producto->codigoMedida === $unidadesMedida->codigo ? 'selected' : ""?>
                            value="<?php echo s($unidadesMedida->codigo); ?>"><?php echo s($unidadesMedida->descripcion);  ?>
                        </option>

                    <?php endforeach ; ?>
                </select> 
    </div>

 

    <div class="campo">
        <label class="campo__name" for="stock">Stock</label>
        <input type="number" id="stock" name="producto[stock]"
        value="<?php echo $producto->stock; ?>"
        >        
    </div>

    <div class="container-input-actualizar">
        <label for="">Imagen</label>
        
        <div class="cajaInputFile">

            <input
                type="file"
                name="file-1"
                id="file-1"
                class="inputfile inputfile-1"  
                accept="image/jpeg, image/png"
            />
            <label for="file-1">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="iborrainputfile"
                    width="20"
                    height="17"
                    viewBox="0 0 20 17"
                >
                    <path
                        d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"
                    ></path>
                </svg>
            <span class="iborrainputfile">Seleccionar archivo</span>
            </label>
      </div>
      <div class="infoImagenActual">
            <?php if ($producto->imagen && file_exists(CARPETA_IMAGENES . $producto->imagen)): ?>
                        <?php echo  "<p id='textoActualizar'> Imagen Actual </p>"?>
                        <img src="/imagenes/<?php echo $producto->imagen ?>" id="imagenActualizar" class="imagen-small" alt="Imagen subida">
            <?php endif ?>  
      </div>
    </div>

    

    <input 
        type="submit" 
        value="Actualizar" 
        class="boton"
        onclick="servicioActualizado(event)"
        >
</form>

<?php
$script = "
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script src='/build/js/alertas.js'></script>
    <script src='https://kit.fontawesome.com/d74a8aa5fa.js' crossorigin='anonymous'></script>
    <script src='/build/js/mostrarFoto.js'></script>
";
?>