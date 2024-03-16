<div class="cajaInfo">
    <div class="cajaInfo-imagen">
        <img src="imagenes/<?php echo $producto->imagen ?>" alt="Imagen del producto">
    </div>
    <div class="cajaInfo-info">
        <p class="pr"><strong>Nombre: </strong> <?php echo $producto->nombre; ?></p>
        <p><strong>Cantidad: </strong> <?php echo $cantidad; ?></p>
        <p><strong>Medida: </strong> <?php echo $producto->codigoMedida; ?></p>
        <p><strong>Precio Total: </strong> <?php echo $total; ?></p>
    </div>
    <div class="cajaInfo-enviar">
        <input type="submit" class="boton2" value="Comprar">
    </div>
</div>