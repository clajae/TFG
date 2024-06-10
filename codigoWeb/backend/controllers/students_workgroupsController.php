<?php
require_once "models/student_workgroupModel.php";
require_once "assets/php/funciones.php";

class Students_WorkgroupsController { 
    private $model;

    public function __construct(){
        $this->model = new Student_WorkgroupModel();
    }

    public function crear(array $arrayStudents_Work_Groups): void
    {
        $error = false;
        $errores = [];

        //campos NO VACIOS
        $arrayNoNulos = ["student_id", "work_group_id"];
        $nulos = HayNulos($arrayNoNulos, $arrayStudents_Work_Groups);

        if (count($nulos) > 0) {
            $error = true;

            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
            }
        }

        $id = null;
        if (!$error) $id = $this->model->insert($arrayStudents_Work_Groups);

        if ($id == null) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayStudents_Work_Groups;
            header("location:backend.php?accion=crear&tabla=student_workgroup&error=true&id={$id}");
            exit ();
        } else {
            // unset borra los datos de dentro de la variable
            unset($_SESSION["errores"]);
            unset($_SESSION["datos"]);
            header("location:backend.php?accion=ver&tabla=student_workgroup&id=" . $id);
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
        $student_workgroup = $this->ver($id);
        $borrado = $this->model->delete($id);
        $redireccion = "location:backend.php?accion=listar&tabla=student_workgroup&evento=borrar&id={$id}";
        
        if ($borrado == false) $redireccion .=  "&error=true";
        header($redireccion);
        exit();
    }
    
    public function buscar(string $campo = "id", string $metodo = "contiene", string $texto = ""): array
    {
        return $this->model->search($campo, $metodo, $texto);
    }
}