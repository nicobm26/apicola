<?php

namespace MVC;

class Router {

    public $rutasGet=[];
    public $rutasPost=[];

    public function get( string $url, array $funcion){
        $this->rutasGet[$url] = $funcion;
        // echo "la url es " . $url;echo '<br>'; // echo '<pre>';var_dump($funcion);echo '</pre>';
    }

    public function post( string $url, array $funcion){
        $this->rutasPost[$url] = $funcion;
    }

    public function comprobarRutas(){

        session_start();

        $auth = $_SESSION['login'] ?? false;

        // Arreglo de rutas protegidas
        $rutasProtegidas = ['/admin', '/producto/agregar' , '/producto/actualizar' , '/producto/eliminar',
        '/vendedor/crear' , '/vendedor/actualizar' , '/vendedor/eliminar'];


        // $urlActual = $_SERVER['PATH_INFO'] ?? "/";
        $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        $metodo = $_SERVER["REQUEST_METHOD"];
        // debugear($urlActual);
        if($metodo === "GET"){
            $funcion = $this->rutasGet[$urlActual] ?? null;
            // debugear($this->rutasGet);
        }else if( $metodo === "POST"){
            $funcion = $this->rutasPost[$urlActual] ?? null;
        }


        // Proteger las rutas
        if(in_array($urlActual, $rutasProtegidas) && !$auth){
            header('Location: /');
        }

        if($funcion){
            // La url existe y hay una funcion asociada

            // echo "funcion: "; echo '<pre>';var_dump($funcion);echo '</pre>';
            // echo "EL objeto this"; echo '<pre>';var_dump($this);echo '</pre>';echo '<br>';
            call_user_func($funcion, $this);
            // call_user_func(callable, parametros opcionales)
            //callable -> Puede ser el nombre de la función como una cadena, un array con un objeto y un nombre de método, o una función anónima. En este caso , un arreglo: controlador, metodo
            // Parámetros opcionales que se pueden pasar a la función que se va a llamar.
        }else{
            //debugear("error 404");
            echo "error en router.php";
        }
    }

     // Muestra una vista
     public function mostrarVista($view, $datos=[]) {
        // $$ -> crear una variable con el nombre de key del arreglo
        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        
        ob_start(); //Almacenamiento en memoria durante un rato

        include __DIR__ . "/views/$view.php";  //Este archivo queda en memoria
        $contenido = ob_get_clean();  //Limpiamos lo que esta en memoria Buffer
        include __DIR__ . "/views/layout.php";
    }
}