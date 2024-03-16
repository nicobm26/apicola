<?php 
    $auth=false;
    if(!isset($_SESSION)){
        $auth = false;
    }else if (isset($_SESSION)  && isset($_SESSION["login"]) ){
        $auth = true;
    }
    
?>
<section id="container-slider">
    <a href="javascript: fntExecuteSlide('prev');" class="arrowPrev"><i class="fas fa-chevron-circle-left"></i></a>
    <a href="javascript: fntExecuteSlide('next');" class="arrowNext"><i class="fas fa-chevron-circle-right"></i></a>
    <ul class="listslider">
        <li><a itlist="itList_0" href="#" class="item-select-slid"></a></li>
        <li><a itlist="itList_1" href="#"></a></li>
        <li><a itlist="itList_2" href="#"></a></li>
    </ul>
    <ul id="slider">
        <li style="background-image: url('../build/img/IlderApicultor.webp'); z-index:0; opacity: 1;">
            <div class="content_slider">
                <div>
                    <h2>Apícolas Génesis</h2>
                    <p>"La miel de la felicidad, ahora a un click de distancia."</p>
                    <?php if(! $auth) : ?>
                        <a href="/login" class="btnSlider">Iniciar Sesión</a>
                    <?php endif ?>                    
                </div>
            </div>
        </li>
        <li style="background-image: url('../build/img/productos.webp');">
            <div class="content_slider">
                <div>
                    <h2>Apícolas Génesis</h2>
                    <p>"Haz clic, endúlzate. La mejor miel, ahora virtualmente tuya".</p>
                    <a href="/login" class="btnSlider">Iniciar Sesión</a>
                </div>
            </div>
        </li>
        <li style="background-image: url('../build/img/presentacion1.webp');">
            <div class="content_slider">
                <div>
                    <h2>Apícolas Génesis</h2>
                    <p>"Tu destino dulce está a un clic de distancia en nuestra tienda de miel online."</p>
                    <a href="/login" class="btnSlider">Iniciar Sesión</a>
                </div>
            </div>
        </li>
    </ul>
</section>
<div class="contenedor">
    <div class="caja-negra">
        <div class="descripcion">
            <h2 class="titulo_apicolas">Apícolas Génesis</h2>
            <p>Bienvenido a Apícolas Génesis, tu destino premium para productos de miel excepcionales. En nuestra tienda, no solo ofrecemos miel de la más alta calidad, sino que también nos esforzamos por proporcionar una experiencia única y satisfactoria para nuestros clientes.</p>
            <p>Descubre la exquisitez de nuestros productos, desde la miel pura y cruda hasta los subproductos de la colmena, como la propóleo y la jalea real. Cada artículo en nuestra tienda ha sido seleccionado con cuidado para garantizar no solo el sabor excepcional, sino también los beneficios para la salud que la miel y sus derivados pueden aportar a tu vida.</p>
            <a href="/nosotros">
                <button class="boton">Ver más</button>
            </a>
        </div>
        <img src="/build/img/productos.JPG" alt="Imagen de la sección">
    </div>
</div>

<div class="caja">
    <h2>Nuestros Productos Estrella</h2>
    <div class="elementos">
        <?php if (isset($productos)) { ?> 
            <?php foreach ( $productos as $producto ) : ?>
                <div class="elemento">
                    <div class="producto">
                        <a href="/producto?codigo=<?php echo $producto->codigo?>">
                            <div class="icono">
                                <img src="/imagenes/<?php echo $producto->imagen?>" alt="imagen de <?php $producto->nombre?>">
                            </div>
                            <p class="subtitulo2"><?php echo $producto->nombre ?></p>
                        </a>                
                    </div>
                </div>  
            <?php endforeach?>
        <?php } else{ ?>
            <p>No hay productos por el momento</p>            
        <?php }  ?>                      
    </div>
</div>

<?php
 $script = "
    <script src='/build/js/index.js'> </script>
    <script defer src='https://use.fontawesome.com/releases/v5.0.6/js/all.js'></script>
 ";
?>