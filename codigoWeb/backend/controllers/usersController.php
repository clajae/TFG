<?php
require_once "models/userModel.php";
require_once "assets/php/funciones.php";

class UsersController { 
    private $model;

    public function __construct(){
        $this->model = new UserModel();
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
        $user = $this->ver($id);
        $borrado = $this->model->delete($id);
        $redireccion = "location:backend.php?accion=listar&tabla=user&evento=borrar&id={$id}&nombre={$user->name}&email={$user->email}&password_key={$user->password_key}";
        
        if ($borrado == false) $redireccion .=  "&error=true";
        header($redireccion);
        exit();
    }
    
    public function buscar(string $campo = "id", string $metodo = "contiene", string $texto = ""): array
    {
        $users = $this->model->search($campo, $metodo, $texto);
        return $users;
    }


}