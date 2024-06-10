<?php
require_once "models/administratorModel.php";
require_once "assets/php/funciones.php";

class AdministratorsController { 
    private $model;

    public function __construct(){
        $this->model = new AdministratorModel();
    }

    public function crear(array $arrayAdministrators): void
    {
        $error = false;
        $errores = [];

        //vaciamos los posibles errores
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];

        // ERRORES DE TIPO
        if (!is_valid_email($arrayAdministrators["email"])) {
        $error = true;
        $errores["email"][] = "El email tiene un formato incorrecto";
        }

        if(!is_valid_password($arrayAdministrators["password"])) {
            $error = true;
            $errores["password"][] = "La contraseña tiene un formato incorrecto";
        }
        
        if(!is_valid_phone($arrayAdministrators["phone"])) {
            $error = true;
            $errores["phone"][] = "El teléfono tiene un formato incorrecto";
        }

        //campos NO VACIOS
        $arrayNoNulos = ["name", "email", "password", "phone", "rol_id"];
        $nulos = HayNulos($arrayNoNulos, $arrayAdministrators);

        if (count($nulos) > 0) {
            $error = true;

            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
            }
        }

        //CAMPOS UNICOS
        $arrayUnicos = ["email"];
        foreach ($arrayUnicos as $CampoUnico) {
            if ($this->model->exists($CampoUnico, $arrayAdministrators[$CampoUnico])) {
                $errores[$CampoUnico][] = "El {$arrayAdministrators[$CampoUnico]} de
                {$CampoUnico} ya existe";
                $error = true;
            }
        }

        $id = null;
        if (!$error) $id = $this->model->insert($arrayAdministrators);

        if ($id == null) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayAdministrators;
            header("location:backend.php?accion=crear&tabla=administrator&error=true&id={$id}");
            exit ();
        } else {
            // unset borra los datos de dentro de la variable
            unset($_SESSION["errores"]);
            unset($_SESSION["datos"]);
            header("location:backend.php?accion=ver&tabla=administrator&id=" . $id);
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
        $administrator = $this->ver($id);
        $borrado = $this->model->delete($id);
        $redireccion = "location:backend.php?accion=listar&tabla=administrator&evento=borrar&id={$id}&nombre={$administrator->name}&email={$administrator->email}";

        if ($borrado == false) $redireccion .=  "&error=true";
        header($redireccion);
        exit();
   }

   public function editar(int $id, array $arrayAdministrator): void 
    {
        $editadoCorrectamente = $this->model->edit($id, $arrayAdministrator);
        $redireccion = "location:backend.php?tabla=administrator&accion=editar&evento=modificar&id={$id}";
        $redireccion .= ($editadoCorrectamente == false) ? "&error=true" : "";
        header($redireccion);
        exit();
    }

    public function buscar(string $campo = "id", string $metodo = "contiene", string $texto = ""): array
    {
        $administrators = $this->model->search($campo, $metodo, $texto);
        return $administrators;
    }


}