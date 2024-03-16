<?php
    $acceso = 0;

    if(!isset($_SESSION))
        session_start();

    $auth = $_SESSION['login'] ?? false;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apícolas Génesis</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/build/css/app.css">
    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16"  href="../build/img/LogoOpcion3.png">

</head>
<body>
    <header class="bg-menu">
        <nav class="nav contenedor">
            <ul class="nav__menu">
                <li class="menu__item">
                    <a href="/" class="item__link">
                        <img class="menu__inicio" src="../build/img/LogoOpcion3.png" alt="Logo de Apicola Genesis">
                </li>
                <li class="menu__item"><a class="item__link" href="/nosotros">Apícolas Génesis</a></li>
                <li class="menu__item"><a class="item__link" href="/productos">Productos</a></li>
                <li class="menu__item"><a class="item__link" href="/contactanos">Contáctenos</a></li>
                <?php if($auth) {  ?>
                    <li class="menu__item"><a class="item__link" href="/carrito">Carrito</a></li>
                    <li class="menu__item"><a class="item__link" href="/logout">Cerrar Sesion</a></li>
                 <?php }else{   ?>
                    <li class="menu__item"><a class="item__link" href="/login">Iniciar Sesión</a></li>                
                <?php } ?>
                
            </ul>
        </nav>
    </header>