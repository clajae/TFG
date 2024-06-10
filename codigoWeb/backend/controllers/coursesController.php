<?php
require_once "models/courseModel.php";
require_once "assets/php/funciones.php";

class CoursesController { 
    private $model;

    public function __construct(){
        $this->model = new CourseModel();
    }

    public function crear(array $arrayCourses): void
    {
        $error = false;
        $errores = [];

        //vaciamos los posibles errores
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];

        //campos NO VACIOS
        $arrayNoNulos = ["name", "duration", "num_lessons", "teacher_id"];
        $nulos = HayNulos($arrayNoNulos, $arrayCourses);

        if (count($nulos) > 0) {
            $error = true;

            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
            }
        }

        $id = null;
        if (!$error) $id = $this->model->insert($arrayCourses);

        if ($id == null) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayCourses;
            header("location:backend.php?accion=crear&tabla=course&error=true&id={$id}");
            exit ();
        } else {
            // unset borra los datos de dentro de la variable
            unset($_SESSION["errores"]);
            unset($_SESSION["datos"]);
            header("location:backend.php?accion=ver&tabla=course&id=" . $id);
            exit ();
        }
    }

    public function ver(int $id): ?stdClass
    {
        return $this->model->read($id);
    }

    public function verCourse(string $email): ?stdClass
    {
        return $this->model->readCourse($email);
    }

    public function listar ():array
    {
        return $this->model->readAll();
    }

    public function listarCourse ():array
    {
        return $this->model->readAllCourse();
    }

    public function borrar(int $id): void
    {
        // Guarda la información del usuario
        $course = $this->ver($id);
        $borrado = $this->model->delete($id);
        $redireccion = "location:backend.php?accion=listar&tabla=course&evento=borrar&id={$id}&nombre={$course->name}&email={$course->email}&num_lessons={$course->num_lessons}";
        
        if ($borrado == false) $redireccion .=  "&error=true";
        header($redireccion);
        exit();
    }
    
    public function buscar(string $campo = "id", string $metodo = "contiene", string $texto = ""): array
    {
        $courses = $this->model->search($campo, $metodo, $texto);
        return $courses;
    }

}