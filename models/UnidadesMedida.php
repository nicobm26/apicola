<?php

namespace Model;

class UnidadesMedida extends ActiveRecord{
    protected static $tabla = 'unidades_medida';
    protected static $columnasDB = ['codigo', 'descripcion', 'abreviatura'];

    public $codigo;
    public $descripcion;
    public $abreviatura;

    public function __construct($args=[])
    {
        $this->codigo = $args['codigo'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->abreviatura = $args['abreviatura'] ?? '';
    }

    public function validar(){
        if(!$this->codigo)
            self::$alertas['error'][] = 'Debe tener un codigo';

        if(!$this->descripcion)
            self::$alertas['error'][] = 'El nombre es obligatorio';

        if(!$this->abreviatura)
            self::$alertas['error'][] = 'Debes añadir una descripcion';   
        
        return self::$alertas;            
    }
}
