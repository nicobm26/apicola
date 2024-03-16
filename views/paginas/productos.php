<h1 class="centrar titulo">productos</h1>


<section class="Cont-Productos">
    <?php
    use Model\UnidadesMedida;
    $unidad = new UnidadesMedida();
    foreach($productos as $producto){
        $unidad = UnidadesMedida::where('codigo', $producto->codigoMedida);
        ?>
    <article class="cont-miel">
        <h2 class="titulo-producto"><?php echo $producto->nombre?></h2>

        <a href="/producto?codigo=<?php echo $producto->codigo?>">
            <img class="imgProductos" src="imagenes/<?php echo $producto->imagen?>" alt="<?php echo $producto->nombre?>">
        </a>            
           
        <p><strong>Medida: </strong><?php echo $producto->cantidad ?> <?php echo (isset($unidad)) ? $unidad->abreviatura : "" ?></p>
        <p><strong>Precio: </strong> <?php echo number_format($producto->precio, 0, ',' , '.')  ?> COP</p>
        <a href="/producto?codigo=<?php echo $producto->codigo?>"><button class="boton">Ver Más</button></a>        
    </article>

    <?php
    }
    ?>
</section>



