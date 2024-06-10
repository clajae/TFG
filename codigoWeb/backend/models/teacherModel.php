<?php
require_once "assets/php/funciones.php"; 
require_once 'userModel.php';
require_once('config/db.php');

class TeacherModel 
{
    private $conexion;
    private $userModel;

    public function __construct()
    {
        $this->conexion = db::conexion();
        $this->userModel = new UserModel();
    }

    public function insert (array $teacher): ?int //devuelve entero o null
    {
        $sql = "INSERT INTO teachers(name, email, password, phone, nationality, rol_id)  VALUES (:name, :email, :password, :phone, :nationality, :rol_id);";
        
        try {
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [
                ":name"=>$teacher["name"],
                ":email"=>$teacher["email"],
                ":password"=>$teacher["password"],
                ":phone"=>$teacher["phone"],
                ":nationality"=>$teacher["nationality"],
                ":rol_id"=>$teacher["rol_id"],
            ];
            $resultado = $sentencia->execute($arrayDatos);

            /*Pasar en el mismo orden de los ? execute devuelve un booleano. 
            True en caso de que todo vaya bien, falso en caso contrario.*/
            //Así podriamos evaluar
            // return ($resultado == true) ? $this->conexion->lastInsertId() : null;

            if ($resultado == true) {

                $user = [
                    "name" => $teacher["name"],
                    "email" => $teacher["email"],
                    "password_key" => $teacher["password"],
                    "rol_id" => 2,
                ];
                $userId = $this->userModel->insert($user);

                if ($userId !== null) {
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
        $sentencia = $this->conexion->prepare("SELECT * FROM teachers WHERE id=:id");
        $arrayDatos = [":id" => $id];
        $resultado = $sentencia->execute($arrayDatos);
        // ojo devuelve true si la consulta se ejecuta correctamente
        // eso no quiere decir que hayan resultados
        if (!$resultado) return null;
        //como sólo va a devolver un resultado uso fetch
        // DE Paso probamos el FETCH_OBJ
        $Teacher = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($Teacher == false) ? null : $Teacher;
    }

    public function readAll():array 
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM teachers");
        //$arrayDatos = [];
        $resultado = $sentencia->execute();
        if ($resultado == false) return [];
        //usamos método query
        // FETCH_ASSOC te devuelve en un Array Asociativo los datos, se accederá: $c[0]['id'] / $teacher["id"]
        // FETCH_OBJ nos devolverá un Array de Objetos, y se accedera: $teacher->id;
        $Teachers = $sentencia->fetchAll(PDO::FETCH_OBJ);    
        return $Teachers;
    }

    public function exists (string $campo, string $valor):bool
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM teachers WHERE $campo=:valor");
        $arrayDatos = [":valor" => $valor];
        $resultado = $sentencia->execute($arrayDatos);
        return (!$resultado || $sentencia->rowCount()<=0)?false:true;
    }

    public function delete (int $id):bool
    {
        $sql="DELETE FROM teachers WHERE id =:id";
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

    public function edit (int $idAntiguo, array $arrayTeacher):bool
    {
        try {
                $sql="UPDATE teachers SET name = :name, email=:email, ";
                $sql.= "password= :password, phone = :phone, nationality = :nationality, rol_id = :rol_id ";
                $sql.= " WHERE id = :id;";
                $arrayDatos=[
                        ":id"=>$idAntiguo,
                        ":name"=>$arrayTeacher["name"],
                        ":email"=>$arrayTeacher["email"],
                        ":password"=>$arrayTeacher["password"],
                        ":phone"=>$arrayTeacher["phone"],
                        ":nationality"=>$arrayTeacher["nationality"],
                        ":rol_id"=>$arrayTeacher["rol_id"],
                        ];
                $sentencia = $this->conexion->prepare($sql);
                return $sentencia->execute($arrayDatos); 
        } catch (Exception $e) {
                echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
                return false;
                }
    }

    public function search (string $campo = "id", string $modoBusqueda = "contiene", string $datoInput = ""):array
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM teachers WHERE $campo LIKE :dato");

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
        $teachers = $sentencia->fetchAll(PDO::FETCH_OBJ); 
        return $teachers; 
    }

    public function login (string $email,string $password): ?stdClass 
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM teachers WHERE
        email=:email and password=:password");
        $arrayDatos = [
        ":email" => $email,
        ":password"=>$password
        ];
        $resultado = $sentencia->execute($arrayDatos);
        if (!$resultado) return null;
        $teacher = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($teacher == false) ? null : $teacher;
    }

}

?>