<h1>Agregar producto</h1>

<div>
    <a href="/medida" class="boton">Volver</a>
</div>

<?php 
    include_once __DIR__ . '/../../templates/alertas.php';
?>

<form method="POST" class="formulario contenedorFormulario" enctype="multipart/form-data">

    <div class="campo">
        <label class="campo__name" for="codigo">Código</label>
        <input type="text" id="codigo" name="producto[codigo]">
    </div>

    <div class="campo">
        <label  class="campo__name" for="descripcion">Nombre</label>
        <input type="text" id="descripcion" name="producto[descripcion]">
    </div>

    <div class="campo">
        <label class="campo__name" for="abreviatura">Abreviatura</label>
        <textarea id="abreviatura" name=producto[abreviatura]"> </textarea>  
    </div>

    <input 
        type="submit" 
        value="Agregar" 
        class="boton"
        onclick="servicioCreado(event)"
        >
</form>


<?php
$script = "
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script src='/build/js/alertas.js'></script>
    <script src='https://kit.fontawesome.com/d74a8aa5fa.js' crossorigin='anonymous'></script>
";
?>