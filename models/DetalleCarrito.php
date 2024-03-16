<?php

namespace Model;

class DetalleCarrito{
    protected static $tabla = 'detallecarrito';
    protected static $columnasDB = ['codigo','codigoCarrito', 'codigoProducto', 'cantidad'];

    public $codigo;
    public $codigoCarrito;
    public $codigoProducto;
    public $cantidad;

    
    public function __construct($args=[])
    {
        $this->codigo = $args['codigo'] ?? null;
        $this->codigoCarrito = $args['codigoCarrito'] ?? '';
        $this->codigoProducto = $args['codigoProducto'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';    
    }
}
