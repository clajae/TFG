<?php
require_once "controllers/administratorsController.php";
//recoger datos
if (!isset ($_REQUEST["name"])){
   header('Location:backend.php?tabla=administrator&accion=crear' );
   exit();
}

$id= ($_REQUEST["id"])??"";//el id me servirá en editar

$arrayAdministrator=[    
                "id"=>$id,
                "name"=>$_REQUEST["name"],
                "email"=>$_REQUEST["email"],
                "password"=>$_REQUEST["password"],
                "phone"=>$_REQUEST["phone"],
                "user_id"=>$_REQUEST["user_id"],
                "rol_id"=>$_REQUEST["rol_id"],
                             
                ];

//pagina invisible
$controlador= new AdministratorsController();

if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayAdministrator);
}

// if ($_REQUEST["evento"]=="modificar"){
//     $controlador->editar ($id, $arrayAdministrator);
// }