<?php 
namespace Controllers;

use Model\Administrador;
use Model\Producto;
use MVC\Router;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use Model\UnidadesMedida;

class AdminController{

    public static function index(Router $router){
        isAdmin();
        $router->mostrarVista("admin/index",[
        ]);
    }

    public static function producto(Router $router){
        isAdmin();
        $productos = Producto::all();
        $producto = null;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){   
            $productos = [];
            $codigo = $_POST['codigo'];
            $producto = Producto::where('codigo', $codigo);
            // debuguear($productos);
        }else if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $productos = Producto::all();            
        }
    
        $router->mostrarVista("admin/producto/index",[
            'productos' => $productos,
            'producto' => $producto
        ]);
    }

    public static function agregarProducto(Router $router){
        isAdmin();
        $alertas=[];

        $unidadesMedidas = UnidadesMedida::all();    
        // debuguear($unidadesMedidas);
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){    
            $producto = new Producto( array_map("trim", $_POST['producto']) );
            $producto->cedulaAdministrador = $_SESSION['cedula'];
            // debuguear($_FILES);
            //$imagen = $_FILES['producto'];

            $hashImagen = md5( uniqid( rand(), true) ); 
            $nombreImagen = lcfirst(str_replace(' ', '', ucwords($producto->nombre)));        
            // debuguear($nombreImagen);
                                    
            $nombreImagen = "{$nombreImagen}_{$hashImagen}.webp";
            // debuguear($nombreImagen);
            // debuguear($nombreImagen);     
            if($_FILES['file-1']['tmp_name']){        
                $producto->setImagen($nombreImagen);
            }
            
            // debuguear($producto);
            $alertas = $producto->validar();
            if(empty($alertas)){
    
                // Crear la carpeta para subir imagenes
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }    

                //Guarda la imagen en el servidor                          
                $manager = new ImageManager(new Driver());
                $image = $manager->read($_FILES['file-1']['tmp_name']);
                $image->toWebp(70)->save(CARPETA_IMAGENES .  $nombreImagen);
                
                // Guarda en la base de datos
                $resultado = $producto->guardarLLaveDefinida('codigo');

                if($resultado) {
                    header('location: /administrarProducto');
                }
            }
        }

        $router->mostrarVista("admin/producto/agregarProducto",[
            'unidadesMedidas' => $unidadesMedidas,
            'alertas' => $alertas
        ]);
    }


    public static function actualizarProducto(Router $router){    
        isAdmin();
        $alertas=[];
        $unidadesMedidas = UnidadesMedida::all();
        $codigo = $_GET['codigo'];
        $productoActual = Producto::where('codigo', $codigo); //Actual
        $producto = Producto::where('codigo', $codigo);  //el que va contener las modificaciones
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $args = array_map("trim", $_POST['producto']);        
            // debuguear($codigoNuevo);
            $producto->sincronizar($args);
      
            // debuguear($_FILES["file-1"]["tmp_name"]);
            
            $alertas = $producto->validar();
            // debuguear($producto);
            //revisar que el arreglo de errores este vacio
            if(empty($alertas)){
                
                //Verificar si subio foto, porque el usuario puede que quiera dejar la foto que tenia
                //tanto con la condicion1


                if($_FILES['file-1']['tmp_name']){                
                    
                    //eliminar la imagen vieja
                    unlink(CARPETA_IMAGENES . $productoActual->imagen);

                    //creando el nuevo nombre para la nueva foto
                    $hashImagen = md5( uniqid( rand(), true) ); 
                    $nombreImagen = lcfirst(str_replace(' ', '', ucwords($producto->nombre)));                    
                    $nombreImagen = "{$nombreImagen}_{$hashImagen}.webp";        
            
                    //seteo el nuevo nombre de la nueva imagen
                    $producto->setImagen($nombreImagen);

                    //Guarda la imagen en el servidor
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($_FILES['file-1']['tmp_name']);
                    $image->toWebp(70)->save(CARPETA_IMAGENES .  $nombreImagen);
                }

                 
                $resultado = $producto->actualizarLlave('codigo', $producto->codigo);

                if($resultado) {
                    header('location: /administrarProducto');
                }
            }
        }

         $router->mostrarVista("admin/producto/actualizarProducto",[
            'unidadesMedidas' => $unidadesMedidas,
            'producto' => $producto,
            'alertas' => $alertas
        ]);
    }

    
    public static function eliminarProducto(){
        isAdmin();

        if($_SERVER['REQUEST_METHOD']=== "POST"){
            // debuguear($_POST);
            $codigo = $_POST["codigo"];   
            $codigo = filter_var($codigo,FILTER_VALIDATE_INT);    
                              
        
            if($codigo){            
                $producto = Producto::where('codigo',$codigo);               
                $rutaImagen = CARPETA_IMAGENES . $producto->imagen;
                // debuguear($rutaImagen);
                
                //Eliminar imagen
                if(file_exists($rutaImagen)){                   
                    unlink($rutaImagen);
                }
            
                $producto->eliminarLlave('codigo',$codigo);
                header('location: /administrarProducto');
            }
        }
    }
    

    // public static function crearAdmin(Router $router){
    //     $cedula = 27840650;
    //     $nombres = "karina";
    //     $apellidos = "mendoza";
    //     $correo = "karina@gmail.com";
    //     $clave = password_hash("Karina1", PASSWORD_BCRYPT);
    //     // debuguear( $clave);
    //     $persona=[
    //         'cedula'=>$cedula, 
    //         'nombres'=>$nombres, 
    //         'apellidos'=>$apellidos, 
    //         'correo'=>$correo,
    //         'clave'=>$clave
    //     ];
    //     $admin = new Administrador($persona);
    //     $admin->guardarLLaveDefinida('cedula');   
    // }

}