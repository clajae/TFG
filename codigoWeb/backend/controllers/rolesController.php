<?php
require_once "models/rolModel.php";
require_once "assets/php/funciones.php";

class RolesController { 
    private $model;

    public function __construct(){
        $this->model = new RolModel();
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
        $rol = $this->ver($id);
        $borrado = $this->model->delete($id);
        $redireccion = "location:backend.php?accion=listar&tabla=rol&evento=borrar&id={$id}&nombre={$rol->name}";
        
        if ($borrado == false) $redireccion .=  "&error=true";
        header($redireccion);
        exit();
    }
    
    public function buscar(string $campo = "id", string $metodo = "contiene", string $texto = ""): array
    {
        $rols = $this->model->search($campo, $metodo, $texto);
        return $rols;
    }

}