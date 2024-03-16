<?php

namespace Model;

class Carrito{
    protected static $tabla = 'carrito';
    protected static $columnasDB = ['codigo','cedulaUsuario', 'total'];

    public $codigo;
    public $cedulaUsuario;
    public $total;
    
    public function __construct($args=[])
    {
        $this->codigo = $args['codigo'] ?? null;
        $this->cedulaUsuario = $args['cedulaUsuario'] ?? '';
        $this->total = $args['total'] ?? '';       
    }
}
