<?php

namespace Model;

class Pago{
    protected static $tabla = 'pago';
    protected static $columnasDB = ['codigo','nombre', 'cantidad', 'fecha'];

    public $codigo;
    public $nombre;
    public $cantidad;
    public $fecha;

    
    public function __construct($args=[])
    {
        $this->codigo = $args['codigo'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->fecha = $args['fecha'] ?? '';    
    }
}