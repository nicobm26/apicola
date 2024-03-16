<?php
include_once __DIR__ . "/../templates/alertas.php";
?>

<div class="login">
    <!-- <img src="assets/img/login-bg.png" alt="login image" class="login__img"> -->
    <!-- <img src="assets/img/FONDO.jfif" alt="login image" class="login__img"> -->

    <form class="login__form" method="POST">
        <h1 class="login__title">Login</h1>

        <div class="login__content">
            <div class="login__box">
                <i class="ri-user-3-line login__icon"></i>

                <div class="login__box-input">
                    <input 
                        type="email" 
                        required 
                        class="login__input" 
                        id="login-email" 
                        placeholder=" "
                        name="correo"
                        >
                    <label for="login-email" class="login__label">Email</label>
                </div>
            </div>

            <div class="login__box">
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
        </div>

        <div class="login__check">
            <div class="login__check-group">
                <input type="checkbox" class="login__check-input" id="login-check">
                <label for="login-check" class="login__check-label">Recordar me</label>
            </div>

            <a href="/olvide" class="login__forgot">Olvidaste tu contraseña?</a>
        </div>

        <button type="submit" class="login__button">Iniciar Sesión</button>

        <p class="login__register">
            No tienes una cuenta? <a href="/registrar">Registrar</a>
        </p>
    </form>
</div>

<?php
    $script = "
    <script src='build/js/mostrarPassword.js'> </script> 
    ";
?>