<?php
require_once "controllers/studentsController.php";
//recoger datos
if (!isset ($_REQUEST["name"])){
   header('Location:backend.php?tabla=student&accion=crear' );
   exit();
}

$id= ($_REQUEST["id"])??"";//el id me servirá en editar

$arrayStudent=[    
                "id"=>$id,
                "name"=>$_REQUEST["name"],
                "email"=>$_REQUEST["email"],
                "password"=>$_REQUEST["password"],
                "phone"=>$_REQUEST["phone"],
                "nationality"=>$_REQUEST["nationality"],
                "age"=>$_REQUEST["age"],
                "user_id"=>$_REQUEST["user_id"],
                "rol_id"=>$_REQUEST["rol_id"],
                             
                ];

//pagina invisible
$controlador= new StudentsController();

if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayStudent);
}

// if ($_REQUEST["evento"]=="modificar"){
//     $controlador->editar ($id, $arrayStudent);
// }