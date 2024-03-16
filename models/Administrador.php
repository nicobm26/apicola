<?php

namespace Model;

class Administrador extends ActiveRecord{
    protected static $tabla = 'administrador';
    protected static $columnasDB = ['cedula','nombres', 'apellidos', 'correo', 'clave'];

    public $cedula;
    public $nombres;
    public $apellidos;
    public $correo;
    public $clave;

    public function __construct($args=[])
    {
        $this->cedula = $args['cedula'] ?? null;
        $this->nombres = $args['nombres'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->clave = $args['clave'] ?? '';
    }

    public function comprobarPassword($passwordUser){
        $resultado = password_verify($passwordUser, trim($this->clave));
        // debuguear($this->clave);
        if( !$resultado){
            self::$alertas['error'][] = "Clave Incorrecta";
        }else{
            return true;
        }
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
}