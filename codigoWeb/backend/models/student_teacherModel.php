<?php
require_once "assets/php/funciones.php"; 
require_once('config/db.php');

class Student_TeacherModel 
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }

    public function insert (array $student_teacher): ?int //devuelve entero o null
    {
        $sql = "INSERT INTO students_teachers(student_id, teacher_id)  VALUES (:student_id, :teacher_id);";
        
        try {
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [
                ":student_id"=>$student_teacher["student_id"],
                ":teacher_id"=>$student_teacher["teacher_id"],
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
        $sentencia = $this->conexion->prepare("SELECT * FROM students_teachers WHERE id=:id");
        $arrayDatos = [":id" => $id];
        $resultado = $sentencia->execute($arrayDatos);
        // ojo devuelve true si la consulta se ejecuta correctamente
        // eso no quiere decir que hayan resultados
        if (!$resultado) return null;
        //como sólo va a devolver un resultado uso fetch
        // DE Paso probamos el FETCH_OBJ
        $Student_Teacher = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($Student_Teacher == false) ? null : $Student_Teacher;
    }

    public function readAll():array 
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM students_teachers");
        //$arrayDatos = [];
        $resultado = $sentencia->execute();
        if ($resultado == false) return [];
        //usamos método query
        // FETCH_ASSOC te devuelve en un Array Asociativo los datos, se accederá: $c[0]['id'] / $student_teacher["id"]
        // FETCH_OBJ nos devolverá un Array de Objetos, y se accedera: $student_teacher->id;
        $student_teachers = $sentencia->fetchAll(PDO::FETCH_OBJ);    
        return $student_teachers;
    }

    public function delete (int $id):bool
    {
        $sql="DELETE FROM students_teachers WHERE id =:id";
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
        $sentencia = $this->conexion->prepare("SELECT * FROM students_teachers WHERE $campo LIKE :dato");

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
        $students_teachers = $sentencia->fetchAll(PDO::FETCH_OBJ); 
        return $students_teachers; 
    }

    public function exists (string $campo, string $valor):bool
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM students_teachers WHERE $campo=:valor");
        $arrayDatos = [":valor" => $valor];
        $resultado = $sentencia->execute($arrayDatos);
        return (!$resultado || $sentencia->rowCount()<=0)?false:true;
    }
}

?>