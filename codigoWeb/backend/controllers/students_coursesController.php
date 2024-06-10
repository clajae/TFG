<?php
require_once "models/student_courseModel.php";
require_once "assets/php/funciones.php";

class Students_CoursesController { 
    private $model;

    public function __construct(){
        $this->model = new Student_CourseModel();
    }

    public function crear(array $arrayStudents_Courses): void
    {
        $error = false;
        $errores = [];

        //vaciamos los posibles errores
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];

        //campos NO VACIOS
        $arrayNoNulos = ["id", "course_id"];
        $nulos = HayNulos($arrayNoNulos, $arrayStudents_Courses);

        if (count($nulos) > 0) {
            $error = true;

            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
            }
        }

        $id = null;
        if (!$error) $id = $this->model->insert($arrayStudents_Courses);

        if ($id == null) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayStudents_Courses;
            header("location:backend.php?accion=crear&tabla=student_course&error=true&id={$id}");
            exit ();
        } else {
            // unset borra los datos de dentro de la variable
            unset($_SESSION["errores"]);
            unset($_SESSION["datos"]);
            header("location:backend.php?accion=ver&tabla=student_course&id=" . $id);
            exit ();
        }
    }

    public function ver(int $id): ?stdClass
    {
        return $this->model->read($id);
    }

    public function listar ():array
    {
        return $this->model->readAll();
    }

    public function borrar(int $id): void
    {
        // Guarda la información del usuario
        $student_course = $this->ver($id);
        $borrado = $this->model->delete($id);
        $redireccion = "location:backend.php?accion=listar&tabla=student_course&evento=borrar&id={$id}";
        
        if ($borrado == false) $redireccion .=  "&error=true";
        header($redireccion);
        exit();
    }
    
    public function buscar(string $campo = "id", string $metodo = "contiene", string $texto = ""): array
    {
        $student_courses = $this->model->search($campo, $metodo, $texto);
        return $student_courses;
    }

}