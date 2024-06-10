<?php
require_once "models/studentModel.php";
require_once "assets/php/funciones.php";

class StudentsController { 
    private $model;

    public function __construct(){
        $this->model = new StudentModel();
    }

    public function crear(array $arrayStudents): void
    {
        $error = false;
        $errores = [];

        //vaciamos los posibles errores
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];

        // ERRORES DE TIPO
        if (!is_valid_email($arrayStudents["email"])) {
        $error = true;
        $errores["email"][] = "El email tiene un formato incorrecto";
        }

        if(!is_valid_password($arrayStudents["password"])) {
            $error = true;
            $errores["password"][] = "La contraseña tiene un formato incorrecto";
        }
        
        if(!is_valid_phone($arrayStudents["phone"])) {
            $error = true;
            $errores["phone"][] = "El teléfono tiene un formato incorrecto";
        }

        //campos NO VACIOS
        $arrayNoNulos = ["name", "email", "password", "phone", "nationality", "age", "rol_id"];
        $nulos = HayNulos($arrayNoNulos, $arrayStudents);

        if (count($nulos) > 0) {
            $error = true;

            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
            }
        }

        //CAMPOS UNICOS
        $arrayUnicos = ["email"];
        foreach ($arrayUnicos as $CampoUnico) {
            if ($this->model->exists($CampoUnico, $arrayStudents[$CampoUnico])) {
                $errores[$CampoUnico][] = "El {$arrayStudents[$CampoUnico]} de
                {$CampoUnico} ya existe";
                $error = true;
            }
        }

        $id = null;
        if (!$error) $id = $this->model->insert($arrayStudents);

        if ($id == null) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayStudents;
            header("location:backend.php?accion=crear&tabla=student&error=true&id={$id}");
            exit ();
        } else {
            // unset borra los datos de dentro de la variable
            unset($_SESSION["errores"]);
            unset($_SESSION["datos"]);
            header("location:backend.php?accion=ver&tabla=student&id=" . $id);
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
        $student = $this->ver($id);
        $borrado = $this->model->delete($id);
        $redireccion = "location:backend.php?accion=listar&tabla=student&evento=borrar&id={$id}&nombre={$student->name}&email={$student->email}&password={$student->password}";
        
        if ($borrado == false) $redireccion .=  "&error=true";
        header($redireccion);
        exit();
    }
    
    public function buscar(string $campo = "id", string $metodo = "contiene", string $texto = ""): array
    {
        $students = $this->model->search($campo, $metodo, $texto);
        return $students;
    }

}