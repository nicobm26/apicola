<div class="login">
    <!-- <img src="assets/img/login-bg.png" alt="login image" class="login__img"> -->
    <!-- <img src="assets/img/FONDO.jfif" alt="login image" class="login__img"> -->

    <?php
    include_once __DIR__ . "/../templates/alertas.php";
    ?>


    <form class="login__form" method="POST" action="/registrar" >
        <h1 class="login__title">Login</h1>

        <div class="login__content">
            <!-- Cedula -->
            <div class="login__box">
                <i class="ri-user-3-line login__icon"></i>

                <div class="login__box-input">
                    <input 
                        type="number" 
                        required 
                        class="login__input" 
                        id="cedula" 
                        name="cedula" 
                        placeholder=" "
                        value="<?php echo s($usuario->cedula) ?>"
                        >
                        
                    <label for="cedula" class="login__label">Cedula</label>
                </div>
            </div>
            <!-- Cedula -->

            <div class="login__box">
                <i class="ri-user-3-line login__icon"></i>

                <div class="login__box-input">
                    <input 
                        type="email" 
                        required 
                        class="login__input" 
                        id="login-email" 
                        name="correo" 
                        placeholder=" "
                        value="<?php echo s($usuario->correo) ?>"
                        >
                        
                    <label for="login-email" class="login__label">Email</label>
                </div>
            </div>

             <!-- Nombre -->
             <div class="login__box">
                <i class="ri-user-3-line login__icon"></i>

                <div class="login__box-input">
                    <input 
                        type="text" 
                        required 
                        class="login__input" 
                        id="nombre" 
                        name="nombres" 
                        placeholder=" "
                        value="<?php echo s($usuario->nombres)?>"
                        >

                    <label for="nombre" class="login__label">Nombres</label>
                </div>
            </div>
            <!-- Nombre -->

            <!-- Apellidos -->
            <div class="login__box">
                <i class="ri-user-3-line login__icon"></i>

                <div class="login__box-input">
                    <input 
                        type="text" 
                        required 
                        class="login__input" 
                        id="apellidos" 
                        name="apellidos" 
                        placeholder=" "
                        value="<?php echo s($usuario->apellidos)?>"
                        >
                    <label for="apellidos" class="login__label">Apellidos</label>
                </div>
            </div>
            <!-- Apellidos -->

            <!-- telefono -->
            <div class="login__box">
                <i class="ri-phone-fill login__icon"></i>

                <div class="login__box-input">
                    <input 
                        type="number" 
                        required 
                        class="login__input" 
                        id="telefono" 
                        name="telefono" 
                        placeholder=" "
                        value="<?php echo s($usuario->telefono)?>"
                        >
                    <label for="telefono" class=" login__label">Telefono</label>
                </div>
            </div>
            <!-- telefono -->

            <!-- clave -->
            <div class="login__box">
                <i class="ri-lock-2-line login__icon"></i>

                <div class="login__box-input">
                    <input type="password" 
                        required 
                        class="login__input" 
                        id="clave" 
                        name="clave" 
                        placeholder=" "
                        >
                    <label for="clave" class="login__label">Contraseña</label>
                    <i class="ri-eye-off-line login__eye" id="login-eye1"></i>
                </div>
            </div>
            <!-- clave -->

             <!-- Repetir clave , para evitar complique-->
             <!-- <div class="login__box">
                <i class="ri-lock-2-line login__icon"></i>

                <div class="login__box-input">
                    <input type="password" required class="login__input" id="clave-repetida" placeholder=" ">
                    <label for="clave-repetida" class="login__label">Repetir Contraseña</label>
                    <i class="ri-eye-off-line login__eye" id="login-eye2"></i>
                </div>
            </div> -->
            <!-- Repetir clave-->
        </div>

        <!-- <div class="login__check">
            <div class="login__check-group">
                <input type="checkbox" class="login__check-input" id="login-check">
                <label for="login-check" class="login__check-label">Recordar me</label>
            </div>

            <a href="#" class="login__forgot">Olvidaste tu contraseña?</a>
        </div> -->

        <button type="submit" class="login__button">Crear Cuenta</button>

        <p class="login__register">
            Ya tienes una cuenta? <a href="/login">Entrar</a>
        </p>
    </form>
</div>

<?php
    $script = "
    <script src='build/js/mostrarPassword.js'> </script> 
    ";
?>