<?php
require_once "controllers/teachersController.php";
//recoger datos
if (!isset ($_REQUEST["name"])){
   header('Location:backend.php?tabla=teacher&accion=crear' );
   exit();
}

$id= ($_REQUEST["id"])??"";//el id me servirá en editar

$arrayTeacher=[    
                "id"=>$id,
                "name"=>$_REQUEST["name"],
                "email"=>$_REQUEST["email"],
                "password"=>$_REQUEST["password"],
                "phone"=>$_REQUEST["phone"],
                "nationality"=>$_REQUEST["nationality"],
                "user_id"=>$_REQUEST["user_id"],
                "rol_id"=>$_REQUEST["rol_id"],
                             
                ];

//pagina invisible
$controlador= new TeachersController();

if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayTeacher);
}

// if ($_REQUEST["evento"]=="modificar"){
//     $controlador->editar ($id, $arrayTeacher);
// }