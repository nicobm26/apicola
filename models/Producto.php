<?php

namespace Model;

class Producto extends ActiveRecord{
    protected static $tabla = 'producto';
    protected static $columnasDB = ['codigo','nombre','descripcion', 'cantidad' ,'precio','stock','imagen','codigoMedida','cedulaAdministrador'];
    
    public $codigo;
    public $nombre;
    public $descripcion;
    public $cantidad;
    public $precio;
    public $stock;
    public $imagen;
    public $codigoMedida;
    public $cedulaAdministrador;
    
    public function __construct($args=[])
    {
        $this->codigo = $args['codigo'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->stock = $args['stock'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->codigoMedida = $args['codigoMedida'] ?? '';
        $this->cedulaAdministrador = $args['cedulaAdministrador'] ?? '';
    }

    public function setImagen($imagen){
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public function validar(){
        if(!$this->codigo)
            self::$alertas['error'][] = 'Debe tener un codigo';

        if(!$this->nombre)
            self::$alertas['error'][] = 'El nombre es obligatorio';

        if(!$this->descripcion)
            self::$alertas['error'][] = 'Debes añadir una descripcion';   
        
        if(!$this->cantidad)
            self::$alertas['error'][] = 'Debes añadir una cantidad';

        if(!$this->precio)
            self::$alertas['error'][] = 'El precio es obligatorio';

        if(!$this->stock)
            self::$alertas['error'][] = 'El stock es obligatorio';       

        if(!$this->codigoMedida)
            self::$alertas['error'][] = 'El codigo de medida es obligatorio';   
        
        return self::$alertas;
    }

    public function devolverUnidad(){
        $unidad = UnidadesMedida::where('codigo', $this->codigoMedida);
        // debuguear($unidad);
        return $unidad;
    }
}