<?php

namespace Model;

class Usuario extends ActiveRecord{
     // Base de Datos
    protected static $tabla = 'usuario';
    protected static $columnasDB = ['cedula','correo','nombres','apellidos','telefono','clave','confirmado','token'];
 
    public $cedula;
    public $correo;
    public $nombres;
    public $apellidos;
    public $telefono;    
    public $clave;    
    public $confirmado;
    public $token;
 
    public function __construct($args=[]){
        $this->cedula = $args['cedula'] ?? null;
        $this->correo = $args['correo'] ?? '';
        $this->nombres = $args['nombres'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->telefono = $args['telefono'] ?? '';        
        $this->clave = $args['clave'] ?? '';       
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }
   
    // Mensajes de validacion para la creacion de una cuenta
    public function validarNuevaCuenta(){

        // Debe tener mínimo 5 dígitos y máximo 11 dígitos
        if (!empty($this->telefono) && !preg_match("/^[0-9]{5,11}$/", $this->telefono)) {
            self::$alertas['error'][] = 'El número de cedula debe tener entre 5 y 11 dígitos.';
        }

        if(!$this->nombres){
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }else if (! preg_match("/^[a-zA-Z ]+$/", $this->nombres)){
            self::$alertas['error'][] = 'El nombre no puede llevar numeros o caraceteres especiales';
        }

        if(!$this->apellidos){
            self::$alertas['error'][] = 'El Apellido es obligatorio';
        }else if (! preg_match("/^[a-zA-Z ]+$/", $this->apellidos)){
            self::$alertas['error'][] = 'El Apellido no puede llevar numeros o caraceteres especiales';
        }
        
        // No es obligatorio el telefono, pero si debe tener el formato de 10 numeros
        if(!empty($this->telefono)  && !preg_match("/^[0-9]{10}$/", $this->telefono)){
            self::$alertas['error'][] = 'El numero de telefono solo puede tener 10 numeros';
        }

        if(empty($this->correo) ){
            self::$alertas['error'][] = 'El correo es obligatorio';
        }else if(!filter_var($this->correo, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El correo no tiene el formato correcto';
        }

        if(!$this->clave){
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        // else if( !preg_match("/^(?=(?:.*[A-Z]){1})(?=(?:.*[a-z]){5,})(?=(?:.*[0-9]){1})/", $this->clave)){
        //     self::$alertas['error'][] = "La contraseña no es válida. Debe contener al menos 5 letras minúsculas, un número y una letra mayúscula.";
        // }

        return self::$alertas;
    }

    public function validarCorreo(){
        if(empty($this->correo) ){
            self::$alertas['error'][] = 'El correo es obligatorio';
        }else if(!filter_var($this->correo, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El correo no tiene el formato correcto';
        }
        return self::$alertas;
    }

    public function validarPassword(){
        if(!$this->clave){
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }else if( !preg_match("/^(?=(?:.*[A-Z]){1})(?=(?:.*[a-z]){5,})(?=(?:.*[0-9]){1})/", $this->clave)){
            self::$alertas['error'][] = "La contraseña no es válida. Debe contener al menos 5 letras minúsculas, un número y una letra mayúscula.";
        }
        return self::$alertas;
    }

    public function validarLogin(){
        if(empty($this->correo) ){
            self::$alertas['error'][] = 'El correo es obligatorio';
        }else if(!filter_var($this->correo, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El correo no tiene el formato correcto';
        }

        if(!$this->clave){
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        // else if( !preg_match("/^(?=(?:.*[A-Z]){1})(?=(?:.*[a-z]){5,})(?=(?:.*[0-9]){1})/", $this->clave)){
        //     self::$alertas['error'][] = "La contraseña no es válida. Debe contener al menos 5 letras minúsculas, un número y una letra mayúscula.";
        // }

        return self::$alertas;
    }

    public function validarNoCrearUsuariosExistentes($resultadoCedula , $resultadoCorreo){
        if( $resultadoCedula==null && $resultadoCorreo !==null){
            //Error, correo ya registrado
            self::$alertas['error'][] = 'El correo ya esta registrado';
        }else if($resultadoCedula!==null && $resultadoCorreo==null){
            //Error, cedula ya registrada
            self::$alertas['error'][] = 'La cedula ya esta registrada';    
        }else if($resultadoCedula!==null && $resultadoCorreo!==null){
            //En teoria nunca tendria que llegar aca, porque solo hay 3 casos posibles
            self::$alertas['error'][] = 'El correo y la cedula ya estan registradas';
        }
        return self::$alertas;
    }

    public function hashPassword(){
        $this->clave = password_hash($this->clave, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        // $this->token = uniqid();
        $this->token = bin2hex(random_bytes(8)); // "8" genera un string aleatorio de 16 caracteres, un poco mas seguro
    }

    public function comprobarPasswordAndVerificado($passwordUser){
        $resultado = password_verify($passwordUser, $this->clave);
        // debuguear($resultado);
        if( !$resultado || !$this->confirmado){
            self::$alertas['error'][] = "Clave Incorrecta";
        }else{
            return true;
        }
    }   
}
?>