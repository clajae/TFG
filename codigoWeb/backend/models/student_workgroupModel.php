<?php
require_once "assets/php/funciones.php"; 
require_once('config/db.php');

class Student_WorkgroupModel 
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }

    public function insert (array $student_work_group): ?int //devuelve entero o null
    {
        $sql = "INSERT INTO students_work_groups(student_id, work_group_id)  VALUES (:student_id, :work_group_id);";
        
        try {
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [
                ":student_id"=>$student_work_group["student_id"],
                ":work_group_id"=>$student_work_group["work_group_id"],
            ];
            $resultado = $sentencia->execute($arrayDatos);

            /*Pasar en el mismo orden de los ? execute devuelve un booleano. 
            True en caso de que todo vaya bien, falso en caso contrario.*/
            //Así podriamos evaluar
            // return ($resultado == true) ? $this->conexion->lastInsertId() : null;

            if ($resultado == true) {
                return $this->conexion->lastInsertId();
            } else {
                return null;
            }

        }  catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
        }
    }

    public function read(int $id): ?stdClass
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM students_work_groups WHERE id=:id");
        $arrayDatos = [":id" => $id];
        $resultado = $sentencia->execute($arrayDatos);
        // ojo devuelve true si la consulta se ejecuta correctamente
        // eso no quiere decir que hayan resultados
        if (!$resultado) return null;
        //como sólo va a devolver un resultado uso fetch
        // DE Paso probamos el FETCH_OBJ
        $Student_Workgroup = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($Student_Workgroup == false) ? null : $Student_Workgroup;
    }

    public function readAll():array 
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM students_work_groups");
        //$arrayDatos = [];
        $resultado = $sentencia->execute();
        if ($resultado == false) return [];
        //usamos método query
        // FETCH_ASSOC te devuelve en un Array Asociativo los datos, se accederá: $c[0]['id'] / $Administrator["id"]
        // FETCH_OBJ nos devolverá un Array de Objetos, y se accedera: $Administrator->id;
        $student_workgroups = $sentencia->fetchAll(PDO::FETCH_OBJ);    
        return $student_workgroups;
    }

    public function delete (int $id):bool
    {
        $sql="DELETE FROM students_work_groups WHERE id =:id";
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

    public function search(string $campo = "id", string $modoBusqueda = "contiene", string $datoInput = ""): array
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM students_work_groups WHERE $campo LIKE :dato");

        if ($modoBusqueda == "empiezaPor") {
            $arrayDatos = [":dato" => "$datoInput%"];
        } elseif ($modoBusqueda == "acabaEn") {
            $arrayDatos = [":dato" => "%$datoInput"];
        } elseif ($modoBusqueda == "contiene") {
            $arrayDatos = [":dato" => "%$datoInput%"];
        } elseif ($modoBusqueda == "iguala") {
            $arrayDatos = [":dato" => "$datoInput"];
        }

        $resultado = $sentencia->execute($arrayDatos);
        if (!$resultado) return [];
        return $sentencia->fetchAll(PDO::FETCH_OBJ); 
    }


    public function exists (string $campo, string $valor):bool
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM students_work_groups WHERE $campo=:valor");
        $arrayDatos = [":valor" => $valor];
        $resultado = $sentencia->execute($arrayDatos);
        return (!$resultado || $sentencia->rowCount()<=0)?false:true;
    }
}

?>