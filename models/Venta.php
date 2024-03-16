<?php

namespace Model;

class Venta{
    protected static $tabla = 'venta';
    protected static $columnasDB = ['codigo','cedulaUsuario', 'total', 'fecha', 'codigoPago', 'codigoDetalleCarrito'];

    public $codigo;
    public $cedulaUsuario;
    public $total;
    public $fecha;
    public $codigoPago;
    public $codigoDetalleCarrito;
    
    public function __construct($args=[])
    {
        $this->codigo = $args['codigo'] ?? null;
        $this->cedulaUsuario = $args['cedulaUsuario'] ?? '';
        $this->total = $args['total'] ?? '';
        $this->fecha = $args['fecha'] ?? '';    
        $this->codigoPago = $args['codigoPago'] ?? '';
        $this->codigoDetalleCarrito = $args['codigoDetalleCarrito'] ?? '';
    }
}
