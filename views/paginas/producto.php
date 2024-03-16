<h1 class="titulo">producto</h1>

<?php
    include_once __DIR__ . '/../templates/alertas.php';
    use Model\UnidadesMedida;
    $unidad = new UnidadesMedida();
    $unidad = UnidadesMedida::where('codigo', $producto->codigoMedida);
?>

<section class="contenedor-producto">

    <article class="productoSeleccionado">
        <h2 class="titulo"><?php echo $producto->nombre ?></h2>
        <img class="imgProducto" src="imagenes/<?php echo $producto->imagen ?>" alt="<?php echo $producto->nombre ?>">
        <p><strong>Cantidad: </strong><?php echo $producto->cantidad ?> <?php echo (isset($unidad)) ? $unidad->abreviatura : "" ?></p>
        <p><strong>Precio:</strong> <?php echo number_format($producto->precio, 0, ',' , '.')?> COP</p>
       
    </article>

    <article class="productoSeleccionado productoSeleccionado__diferente">
        <h2 class="titulo">Información</h2>
            <form method="post">
                        
            <p>Cantidad 
                <select id="cantidad" name="cantidad">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10+</option>
                </select></p>
                <input type="hidden" name="codigo" value="<?php echo $producto->codigo ?>">
                <input type="submit" class="boton" formaction="/comprar" name="accion" value="Comprar">
                <input type="submit" class="boton" name="accion" value="AgregarCarrito">
            </form>
            
    </article>
</section>