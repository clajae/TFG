<?php
require_once "models/workgroupModel.php";
require_once "assets/php/funciones.php";

class WorkgroupsController { 
    private $model;

    public function __construct(){
        $this->model = new WorkgroupModel();
    }

    public function crear(array $arrayWorkgroups): void
    {
        $error = false;
        $errores = [];

        //vaciamos los posibles errores
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];

        //campos NO VACIOS
        $arrayNoNulos = ["name", "teacher_id"];
        $nulos = HayNulos($arrayNoNulos, $arrayWorkgroups);

        if (count($nulos) > 0) {
            $error = true;

            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
            }
        }

        $id = null;
        if (!$error) $id = $this->model->insert($arrayWorkgroups);

        if ($id == null) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayWorkgroups;
            header("location:backend.php?accion=workgroup&tabla=workgroup&error=true&id={$id}");
            exit ();
        } else {
            // unset borra los datos de dentro de la variable
            unset($_SESSION["errores"]);
            unset($_SESSION["datos"]);
            header("location:backend.php?accion=ver&tabla=workgroup&id=" . $id);
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
        $work_group = $this->ver($id);
        $borrado = $this->model->delete($id);
        $redireccion = "location:backend.php?accion=listar&tabla=workgroup&evento=borrar&id={$id}&nombre={$work_group->name}&teacher_id={$work_group->teacher_id}";
        
        if ($borrado == false) $redireccion .=  "&error=true";
        header($redireccion);
        exit();
    }
    
    public function buscar(string $campo = "id", string $metodo = "contiene", string $texto = ""): array
    {
        $work_groups = $this->model->search($campo, $metodo, $texto);
        return $work_groups;
    }

}