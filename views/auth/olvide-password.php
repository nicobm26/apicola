<h1 class="titulo">Olvide Contraseña</h1>
<p class="centrar">Reestablece tu contraseña escribiendo tu email a continuación</p>

<?php
    include_once __DIR__ . "/../templates/alertas.php";
?>


<div class="forget">
    <!-- <img src="assets/img/login-bg.png" alt="login image" class="login__img"> -->
    <!-- <img src="assets/img/FONDO.jfif" alt="login image" class="login__img"> -->

    <form class="login__form" method="POST">
        
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
        </div>

        <button type="submit" class="login__button">Enviar Instrucciones</button>

        <p class="login__register">
            No tienes una cuenta? <a href="/registrar">Registrar</a>
        </p>

        <p class="login__register">
            Ya tienes una cuenta? <a href="/login">Iniciar Sesion</a>
        </p>
        
    </form>
    
</div>

