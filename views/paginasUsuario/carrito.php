<?php
include_once __DIR__ . '/../templates/alertas.php';
use Model\UnidadesMedida;
$unidad = new UnidadesMedida();
// debuguear($_SESSION['carrito']);
?>
<div class="contenedor-carrito">
    <h2 class="titulo">Carro De compras</h2>
    <div class="carrito__producto">
        <?php 
        $contador=0;
        foreach ($productos as $producto) { 
            $unidad = UnidadesMedida::where('codigo', $producto->codigoMedida);    
        ?>

        <div class="cajaCarrito">            
            <div class="carrito__item">
                <div class="carrito__item__img">
                    <img src="/imagenes/<?php echo $producto->imagen ?>" alt="Imagen del producto">
                </div>
               <div class="carrito__item__info">
                    <p> <?php echo $producto->nombre ?> </p>
                    <p> <?php echo $producto->cantidad ?>  <?php echo (isset($unidad)) ? $unidad->abreviatura : ""?> </p>
               </div>                
            </div>

            <div>
                <p><span>Cantidad: </span>
                <?php                  
                    echo $_SESSION['carrito'][$contador]['cantidad'];
                ?>
                </p>
            </div>

            <p><span>Total: </span>
            <?php                
                    echo $_SESSION['carrito'][$contador]['cantidad'] * $producto->precio;
            ?>
            </p>

            <div>
                <form action="#" method="post" class="formEliminarCarrito">
                    <input type="hidden"  value="<?php echo $producto->codigo ?>">
                    <input class="boton2" type="submit" value="Eliminar">
                </form>

            </div>
       
        </div>



        <?php 
         $contador =  $contador + 1;
        } 
        ?>

    </div> <!-- .carrito__producto -->
</div>  <!-- .contenedor-carrito -->