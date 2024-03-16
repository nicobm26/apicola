<?php
namespace Model;

class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Alertas y Mensajes
    protected static $alertas = [];
    
    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Validación
    public static function getAlertas() {
        return static::$alertas;
    }

    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria
    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos() { 
        $atributos = [];         
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;          
            $atributos[$columna] = $this->$columna;           
        }      
        return $atributos;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarAtributos() {
        $atributos = $this->atributos();    
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }    
        return $sanitizado;
    }

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    // Registros - CRUD
    public function guardar() {
        $resultado = '';
        if(!is_null($this->id)) {
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }

    // Registros - CRUD
    //Es decir, la llave primaria no es generada automaticamente
    public function guardarLLaveDefinida($clavePrimaria) {
        $resultado = '';
        $resultado =  $this->where($clavePrimaria, $this->$clavePrimaria);
        // debuguear($resultado);
        if(!is_null($this->where($clavePrimaria, $this->$clavePrimaria))) {
            // actualizar  
            // debuguear($resultado);
            // debuguear("actualizar");
            $resultado = $resultado->sanitizarAtributos();

            if (array_key_exists("id", $resultado)) {
                $resultado = $this->actualizar();
            }else{
                $resultado = $this->actualizar($clavePrimaria, $resultado[$clavePrimaria]);
            }            
        } else {
            // Creando un nuevo registro
            // debuguear('crear');
            $resultado = $this->crear();
        }
        return $resultado;
    }

    // Todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Obtiene determinado numero de registros
    public static function some($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT $cantidad";    
        $resultado= self::consultarSQL($query);        
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = $id";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Obtener Registros con cierta cantidad
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT $limite";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Busca un registro por una columna y un valor asociado
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE TRIM($columna)='$valor'";
        //debuguear($query);
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // crea un nuevo registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        // Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));
        $query .= ") VALUES ('"; 
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

        // debuguear($query);
        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return [
           'resultado' =>  $resultado,
           'id' => self::$db->insert_id
        ];
    }

    // crea un nuevo registro, NO la estoy usando
    public function crearLLaveDefinida() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return [
           'resultado' =>  $resultado           
        ];
    }

    // Actualizar el registro
    public function actualizar($llavePrimaria = null, $valor = "") {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        // debuguear($atributos);

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        if($llavePrimaria == null){
            // Consulta SQL
            //Teniendo en cuenta que solo se puede cuando la llave primaria se llama id y es autoincrementable
            $query = "UPDATE " . static::$tabla ." SET ";
            $query .=  join(', ', $valores );
            $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
            $query .= " LIMIT 1 "; 
        }else{
            $query = "UPDATE " . static::$tabla ." SET ";
            $query .=  join(', ', $valores );
            $query .= " WHERE $llavePrimaria = '" . trim($valor) . "' ";
            $query .= " LIMIT 1 "; 
        }

        // debuguear($query);
        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }

     // Actualizar el registro, con la diferentecia que la llave primaria puede ser cualquiera y no solo 'id'
     public function actualizarLlave($llave, $valor) {
        // Sanitizar los datos
        // debuguear($this);
        $atributos = $this->sanitizarAtributos();
        // debuguear($atributos);
        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        // debuguear($valores);
        // Consulta SQL
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE $llave = '$valor' ";
        $query .= " LIMIT 1 "; 
        // debuguear($query);
        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Eliminar un Registro por su ID
    public function eliminar() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

     // Eliminar un Registro por su ID
     public function eliminarLlave($llave,$valor) {
        $query = "DELETE FROM "  . static::$tabla . " WHERE $llave = $valor LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function eliminarLlaveExcepciones($llave,$valor) {
        $resultado=null;
        try {
            $query = "DELETE FROM " . static::$tabla . " WHERE $llave = $valor LIMIT 1";
            // debuguear($query);
            $resultado = self::$db->query($query);
            // debuguear($query);

            if ($resultado === false) {
                $errorInfo = self::$db->errorInfo();
                // Verifica si el código de error es '23000' (violación de integridad referencial)
                if ($errorInfo[1] == '23000') {
                    echo "Error: No se puede eliminar la llave primaria porque está siendo referenciada en otro lugar.";
                } else {
                    echo "Error: " . $errorInfo[2]; // Otro tipo de error
                }
            } else {
                // Resto de tu código después de la eliminación exitosa
                echo "Llave primaria eliminada exitosamente";
            }
        } catch (Exception $e) {
            // Otras excepciones generales (no relacionadas con la base de datos)
            echo "Error: " . $e->getMessage();
        }
        return $resultado;
    }

}