<?php
require_once "models/teacherModel.php";
require_once "assets/php/funciones.php";

class TeachersController { 
    private $model;

    public function __construct(){
        $this->model = new TeacherModel();
    }

    public function crear(array $arrayTeachers): void
    {
        $error = false;
        $errores = [];

        //vaciamos los posibles errores
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];

        // ERRORES DE TIPO
        if (!is_valid_email($arrayTeachers["email"])) {
        $error = true;
        $errores["email"][] = "El email tiene un formato incorrecto";
        }

        if(!is_valid_password($arrayTeachers["password"])) {
            $error = true;
            $errores["password"][] = "La contraseña tiene un formato incorrecto";
        }
        
        if(!is_valid_phone($arrayTeachers["phone"])) {
            $error = true;
            $errores["phone"][] = "El teléfono tiene un formato incorrecto";
        }

        //campos NO VACIOS
        $arrayNoNulos = ["name", "email", "password", "phone", "nationality", "rol_id"];
        $nulos = HayNulos($arrayNoNulos, $arrayTeachers);

        if (count($nulos) > 0) {
            $error = true;

            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
            }
        }

        //CAMPOS UNICOS
        $arrayUnicos = ["email"];
        foreach ($arrayUnicos as $CampoUnico) {
            if ($this->model->exists($CampoUnico, $arrayTeachers[$CampoUnico])) {
                $errores[$CampoUnico][] = "El {$arrayTeachers[$CampoUnico]} de
                {$CampoUnico} ya existe";
                $error = true;
            }
        }

        $id = null;
        if (!$error) $id = $this->model->insert($arrayTeachers);

        if ($id == null) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayTeachers;
            header("location:backend.php?accion=crear&tabla=teacher&error=true&id={$id}");
            exit ();
        } else {
            // unset borra los datos de dentro de la variable
            unset($_SESSION["errores"]);
            unset($_SESSION["datos"]);
            header("location:backend.php?accion=ver&tabla=teacher&id=" . $id);
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
        $teacher = $this->ver($id);
        $borrado = $this->model->delete($id);
        $redireccion = "location:backend.php?accion=listar&tabla=teacher&evento=borrar&id={$id}&nombre={$teacher->name}&email={$teacher->email}";
        
        if ($borrado == false) $redireccion .=  "&error=true";
        header($redireccion);
        exit();
   }

   public function editar (int $id, array $arrayTeacher):void 
    {
        $editadoCorrectamente=$this->model->edit ($id, $arrayTeacher);
        //lo separo para que se lea mejor en el word
        $redireccion="location:backend.php?tabla=teacher&accion=editar";
        $redireccion.="&evento=modificar&id={$id}";
        $redireccion.=($editadoCorrectamente==false)?"&error=true":"";
        //vuelvo a la pagina donde estaba
        header ($redireccion);
        exit();
    }

    public function buscar(string $campo = "id", string $metodo = "contiene", string $texto = ""): array
    {
        $teachers = $this->model->search($campo, $metodo, $texto);
        return $teachers;
    }
}