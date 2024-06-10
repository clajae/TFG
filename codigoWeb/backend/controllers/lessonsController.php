<?php
require_once "models/lessonModel.php";
require_once "assets/php/funciones.php";

class LessonsController { 
    private $model;

    public function __construct(){
        $this->model = new LessonModel();
    }

    public function crear(array $arrayLessons): void
    {
        $error = false;
        $errores = [];

        //vaciamos los posibles errores
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];

        //campos NO VACIOS
        $arrayNoNulos = ["name", "duration", "url", "course_id"];
        $nulos = HayNulos($arrayNoNulos, $arrayLessons);

        if (count($nulos) > 0) {
            $error = true;

            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
            }
        }


        $id = null;
        if (!$error) $id = $this->model->insert($arrayLessons);

        if ($id == null) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayLessons;
            header("location:backend.php?accion=crear&tabla=lesson&error=true&id={$id}");
            exit ();
        } else {
            // unset borra los datos de dentro de la variable
            unset($_SESSION["errores"]);
            unset($_SESSION["datos"]);
            header("location:backend.php?accion=ver&tabla=lesson&id=" . $id);
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
        $lesson = $this->ver($id);
        $borrado = $this->model->delete($id);
        $redireccion = "location:backend.php?accion=listar&tabla=lesson&evento=borrar&id={$id}&nombre={$lesson->name}&email={$lesson->email}&password_key={$lesson->password_key}";
        
        if ($borrado == false) $redireccion .=  "&error=true";
        header($redireccion);
        exit();
    }
    
    public function buscar(string $campo = "id", string $metodo = "contiene", string $texto = ""): array
    {
        $lessons = $this->model->search($campo, $metodo, $texto);
        return $lessons;
    }

}