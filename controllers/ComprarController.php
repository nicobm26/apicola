<?php 

namespace Controllers;

use MVC\Router;
use Model\Producto;
use Model\UnidadesMedida;

class ComprarController{

    public static function comprar(Router $router){   
        $cantidad=[];
        $producto=[];
        $total="";
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $codigo = $_POST['codigo'];
            $cantidad = $_POST['cantidad'];
            $producto = Producto::where('codigo', $codigo);
            $total = $cantidad * $producto->precio;
            $total = number_format($total,0,',','.');
            $router->mostrarVista('paginas/comprar', [
                'cantidad' => $cantidad,
                'producto' => $producto,
                'total' => $total
            ]);    
        }if($_SERVER['REQUEST_METHOD'] === 'GET'){
            header('Location: /productos');
        }
        
    }

    public static function carrito(Router $router){
        isAuth();
        $alertas=[];
        $productos=[];
        $medida = new UnidadesMedida();
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if( !isset($_SESSION['carrito']) || empty($_SESSION['carrito'])){
                $alertas['error'][] = 'No hay productos agregados al carrito';
            }else{                
                foreach ($_SESSION['carrito'] as $producto) {
                    // Accedemos a los datos del producto actual
                    $codigo = $producto['codigo'];
                    $cantidad = $producto['cantidad'];
                    $producto = Producto::where('codigo', $codigo);
                    $productos[] = $producto;
                }                
            }
        }else if($_SERVER['REQUEST_METHOD'] == 'POST'){

        }
        
        $router->mostrarVista('paginasUsuario/carrito', [                       
            'alertas'=> $alertas ,
            'productos' => $productos
        ]);    
    }

    public static function eliminarProducto(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $codigo = $_POST['codigoEliminar'];
            // debuguear($_SESSION['carrito']);
            
            // Buscar el arreglo por el código
            foreach ($_SESSION['carrito'] as $key => $valor) {
                if ($valor["codigo"] == $codigo) {
                    // Eliminar el arreglo encontrado
                    unset($_SESSION['carrito'][$key]);
                    break; // Terminar el bucle una vez que se haya encontrado y eliminado el arreglo
                }
            }
            header('location: /carrito');
        }   
    }

}