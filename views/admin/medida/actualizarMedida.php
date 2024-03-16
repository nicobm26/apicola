<h1>Actualizar unidad</h1>

<div>
    <a href="/medida" class="boton">Volver</a>
</div>

<?php 
    include_once __DIR__ . '/../../templates/alertas.php';
?>

<form method="POST" class="formulario contenedorFormulario">

    <div class="campo">
        <label class="campo__name" for="codigo">Código</label>
        <input type="text" id="codigo" name="unidad[codigo]" 
        value="<?php echo $unidad->codigo; ?>"
        >
    </div>

    <div class="campo">
        <label class="campo__name" for="descripcion">Nombre</label>
        <input type="text" id="descripcion" name="unidad[descripcion]"
        value="<?php echo $unidad->descripcion; ?>"
        >
    </div>

    <div class="campo">
        <label class="campo__name" for="abreviatura">Abreviatura</label>
        <textarea id="abreviatura" name=unidad[abreviatura]"> <?php echo $unidad->abreviatura; ?>
        </textarea>  
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
";
?>