<h1 class="titulo">Recuperar Password</h1>
<p class="centrar">Coloca tu nuevo password a continuación</p>

<?php
    include_once __DIR__ . "/../templates/alertas.php";
?>

<?php  if ($error) return;?>

<div class="forget">
    <!-- <img src="assets/img/login-bg.png" alt="login image" class="login__img"> -->
    <!-- <img src="assets/img/FONDO.jfif" alt="login image" class="login__img"> -->

    <form class="login__form" method="POST">
            
        <div class="login__box clave">
            <i class="ri-lock-2-line login__icon"></i>

            <div class="login__box-input">
                <input 
                    type="password" 
                    required 
                    class="login__input" 
                    id="login-pass" 
                    placeholder=" "
                    name="clave"
                    >
                <label for="login-pass" class="login__label">Contraseña</label>
                <i class="ri-eye-off-line login__eye" id="login-eye"></i>
            </div>
        </div>

        <button type="submit" class="login__button">Cambiar Contraseña</button>

        <p class="login__register">
            No tienes una cuenta? <a href="/registrar">Registrar</a>
        </p>

        <p class="login__register">
            Ya tienes una cuenta? <a href="/login">Iniciar Sesion</a>
        </p>
        
    </form>    
</div>


<?php
    $script = "
    <script src='build/js/mostrarPassword.js'> </script> 
    ";
?>
