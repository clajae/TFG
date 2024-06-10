<?php
require_once "assets/php/funciones.php"; 
require_once 'administratorModel.php';
require_once('config/db.php');

class AdministratorModel 
{
    private $conexion;
    private $administratorModel;

    public function __construct()
    {
        $this->conexion = db::conexion();
        $this->administratorModel = new administratorModel();
    }

    public function insert (array $administrator): ?int //devuelve entero o null
    {
        $sql = "INSERT INTO administrators(name, email, password, phone, rol_id)  VALUES (:name, :email, :password, :phone, :rol_id);";
        
        try {
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [
                ":name"=>$administrator["name"],
                ":email"=>$administrator["email"],
                ":password"=>$administrator["password"],
                ":phone"=>$administrator["phone"],
                ":rol_id"=>$administrator["rol_id"],
            ];
            $resultado = $sentencia->execute($arrayDatos);

            /*Pasar en el mismo orden de los ? execute devuelve un booleano. 
            True en caso de que todo vaya bien, falso en caso contrario.*/
            //Así podriamos evaluar
            // return ($resultado == true) ? $this->conexion->lastInsertId() : null;

            if ($resultado == true) {

                $administrator = [
                    "name" => $administrator["name"],
                    "email" => $administrator["email"],
                    "password_key" => $administrator["password"],
                    "rol_id" => 3,
                ];
                $administratorId = $this->administratorModel->insert($administrator);

                if ($administratorId !== null) {
                    return $this->conexion->lastInsertId();

                } else {
                    return null;
                }
            } else {
                // Revertir la transacción si hubo un error en la inserción en profesores
                $this->conexion->rollBack();
                return null;
            }

        }  catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
        }
    }

    public function read(int $id): ?stdClass
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM administrators WHERE id=:id");
        $arrayDatos = [":id" => $id];
        $resultado = $sentencia->execute($arrayDatos);
        // ojo devuelve true si la consulta se ejecuta correctamente
        // eso no quiere decir que hayan resultados
        if (!$resultado) return null;
        //como sólo va a devolver un resultado uso fetch
        // DE Paso probamos el FETCH_OBJ
        $Administrator = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($Administrator == false) ? null : $Administrator;
    }

    public function readAll():array 
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM administrators");
        //$arrayDatos = [];
        $resultado = $sentencia->execute();
        if ($resultado == false) return [];
        //usamos método query
        // FETCH_ASSOC te devuelve en un Array Asociativo los datos, se accederá: $c[0]['id'] / $Administrator["id"]
        // FETCH_OBJ nos devolverá un Array de Objetos, y se accedera: $Administrator->id;
        $Administratores = $sentencia->fetchAll(PDO::FETCH_OBJ);    
        return $Administratores;
    }

    public function delete (int $id):bool
    {
        $sql="DELETE FROM administrators WHERE id =:id";
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

    public function edit(int $idAntiguo, array $arrayAdministrator): bool
    {
        try {
            $sql = "UPDATE administrators SET name = :name, email = :email, ";
            $sql .= "password = :password, phone = :phone, rol_id = :rol_id ";
            $sql .= "WHERE id = :id;";
            $arrayDatos = [
                ":id" => $idAntiguo,
                ":name" => $arrayAdministrator["name"],
                ":email" => $arrayAdministrator["email"],
                ":password" => $arrayAdministrator["password"],
                ":phone" => $arrayAdministrator["phone"],
                ":rol_id" => $arrayAdministrator["rol_id"],
            ];
            $sentencia = $this->conexion->prepare($sql);
            return $sentencia->execute($arrayDatos);
        } catch (Exception $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "<br>";
            return false;
        }
    }

    public function search (string $campo = "id", string $modoBusqueda = "contiene", string $datoInput = ""):array
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM administrators WHERE $campo LIKE :dato");

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
        $administrators = $sentencia->fetchAll(PDO::FETCH_OBJ); 
        return $administrators; 
    }

    public function login (string $email,string $password): ?stdClass 
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM administrators WHERE
        email=:email and password=:password");
        $arrayDatos = [
        ":email" => $email,
        ":password"=>$password
        ];
        $resultado = $sentencia->execute($arrayDatos);
        if (!$resultado) return null;
        $administrator = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($administrator == false) ? null : $administrator;
    }


    public function exists (string $campo, string $valor):bool
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM administrators WHERE $campo=:valor");
        $arrayDatos = [":valor" => $valor];
        $resultado = $sentencia->execute($arrayDatos);
        return (!$resultado || $sentencia->rowCount()<=0)?false:true;
    }


}

?>