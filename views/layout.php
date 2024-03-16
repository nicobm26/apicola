<?php    

//  include_once 'templates/header.php';
    if(isset($_SESSION)){
        //Se logio 
        $acceso=1;
        if(isset($_SESSION['rol'])){
            $acceso=2;
            include_once __DIR__ . '/templates/headerAdmin.php';
        }else if(isset($_SESSION)){
            include_once __DIR__ .'/templates/header.php';
        }
    }else{
        include_once 'templates/header.php';
    }
?>

    <!-- <div class="contenedor-app">
        <div class="app"> -->
            <?php echo $contenido; ?>            
        <!-- </div> -->
    <!-- </div> -->

    <?php
        include_once __DIR__ . "/templates/footer.php";
    ?>
    <?php
        echo $script ?? '';
    ?>      
    <!-- <script src="../build/js/bundle.min.js"></script> -->
</body>
</html>
