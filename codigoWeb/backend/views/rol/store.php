<?php
require_once "controllers/rolesController.php";
//recoger datos
if (!isset ($_REQUEST["name"])){
   header('Location:backend.php?tabla=rol&accion=crear' );
   exit();
}

$id= ($_REQUEST["id"])??"";//el id me servirá en editar

$arrayRol=[    
                "id"=>$id,
                "name"=>$_REQUEST["name"],
                             
                ];

//pagina invisible
$controlador= new RolesController();

if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayRol);
}

// if ($_REQUEST["evento"]=="modificar"){
//     $controlador->editar ($id, $arrayRol);
// }