<?php
require_once "controllers/workgroupsController.php";
//recoger datos
if (!isset ($_REQUEST["name"])){
   header('Location:backend.php?tabla=workgroup&accion=crear' );
   exit();
}

$id= ($_REQUEST["id"])??"";//el id me servirá en editar

$arrayWorkgroup=[    
                "id"=>$id,
                "name"=>$_REQUEST["name"],
                "teacher_id"=>$_REQUEST["teacher_id"],
                             
                ];

//pagina invisible
$controlador= new WorkgroupsController();

if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayWorkgroup);
}

// if ($_REQUEST["evento"]=="modificar"){
//     $controlador->editar ($id, $arrayWorkgroup);
// }