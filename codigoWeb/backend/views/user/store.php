<?php
require_once "controllers/usersController.php";
//recoger datos
if (!isset ($_REQUEST["name"])){
   header('Location:backend.php?tabla=user&accion=crear' );
   exit();
}

$id= ($_REQUEST["id"])??"";//el id me servirá en editar

$arrayUser=[    
                "id"=>$id,
                "name"=>$_REQUEST["name"],
                "email"=>$_REQUEST["email"],
                "password_key"=>$_REQUEST["password_key"],
                "rol_id"=>$_REQUEST["rol_id"],
                             
                ];

//pagina invisible
$controlador= new UsersController();

if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayUser);
}

// if ($_REQUEST["evento"]=="modificar"){
//     $controlador->editar ($id, $arrayUser);
// }