<?php
require_once "assets/php/funciones.php"; 
require_once('config/db.php');

class UserModel 
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }

    public function insert (array $user): ?int //devuelve entero o null
    {
        $sql = "INSERT INTO users(name, email, password_key, rol_id)  VALUES (:name, :email, :password_key, :rol_id);";
        
        try {
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [
                ":name"=>$user["name"],
                ":email"=>$user["email"],
                ":password_key"=>$user["password_key"],
                ":rol_id"=>$user["rol_id"],
            ];
            $resultado = $sentencia->execute($arrayDatos);

            /*Pasar en el mismo orden de los ? execute devuelve un booleano. 
            True en caso de que todo vaya bien, falso en caso contrario.*/
            //Así podriamos evaluar
            return ($resultado == true) ? $this->conexion->lastInsertId() : null;
        }  catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
        }
    }

    public function read(int $id): ?stdClass
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM users WHERE id=:id");
        $arrayDatos = [":id" => $id];
        $resultado = $sentencia->execute($arrayDatos);
        // ojo devuelve true si la consulta se ejecuta correctamente
        // eso no quiere decir que hayan resultados
        if (!$resultado) return null;
        //como sólo va a devolver un resultado uso fetch
        // DE Paso probamos el FETCH_OBJ
        $User = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($User == false) ? null : $User;
    }

    public function readAll():array 
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM users");
        //$arrayDatos = [];
        $resultado = $sentencia->execute();
        if ($resultado == false) return [];
        //usamos método query
        // FETCH_ASSOC te devuelve en un Array Asociativo los datos, se accederá: $c[0]['id'] / $Administrator["id"]
        // FETCH_OBJ nos devolverá un Array de Objetos, y se accedera: $Administrator->id;
        $users = $sentencia->fetchAll(PDO::FETCH_OBJ);    
        return $users;
    }

    public function delete (int $id):bool
    {
        $sql="DELETE FROM users WHERE id =:id";
        try {
            $sentencia = $this->conexion->prepare($sql);
            //devuelve true si se borra correctamente
            //false si falla el borrado
            $resultado= $sentencia->execute([":id" => $id]);
            return ($sentencia->rowCount ()<=0)?false:true;
        }  catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return false;
        }
    }

    public function search (string $campo = "id", string $modoBusqueda = "contiene", string $datoInput = ""):array
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM users WHERE $campo LIKE :dato");

        //ojo el si ponemos % siempre en comillas dobles "
        if ($modoBusqueda == "empiezaPor") {
            $arrayDatos=[":dato"=>"$datoInput%" ];
        } elseif ($modoBusqueda == "acabaEn") {
            $arrayDatos=[":dato"=>"%$datoInput" ];
        } elseif ($modoBusqueda == "contiene") {
            $arrayDatos=[":dato"=>"%$datoInput%" ];
        } elseif ($modoBusqueda == "iguala") {
            $arrayDatos=[":dato"=>"$datoInput" ];
        }

        $resultado = $sentencia->execute($arrayDatos);
        if (!$resultado) return [];
        $users = $sentencia->fetchAll(PDO::FETCH_OBJ); 
        return $users; 
    }

    public function login (string $email,string $password_key): ?stdClass 
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM users WHERE
        email=:email and password_key=:password_key");
        $arrayDatos = [
        ":email" => $email,
        ":password_key"=>$password_key
        ];
        $resultado = $sentencia->execute($arrayDatos);
        if (!$resultado) return null;
        $user = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($user == false) ? null : $user;
    }

    public function exists (string $campo, string $valor):bool
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM users WHERE $campo=:valor");
        $arrayDatos = [":valor" => $valor];
        $resultado = $sentencia->execute($arrayDatos);
        return (!$resultado || $sentencia->rowCount()<=0)?false:true;
    }

}

?>