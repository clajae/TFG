<?php
require_once "controllers/lessonsController.php";
//recoger datos
if (!isset ($_REQUEST["name"])){
   header('Location:backend.php?tabla=lesson&accion=crear' );
   exit();
}

$id= ($_REQUEST["id"])??"";//el id me servirá en editar

$arrayLesson=[    
                "id"=>$id,
                "name"=>$_REQUEST["name"],
                "duration"=>$_REQUEST["duration"],
                "url"=>$_REQUEST["url"],
                "course_id"=>$_REQUEST["course_id"],
                             
                ];

//pagina invisible
$controlador= new LessonsController();

if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayLesson);
}

// if ($_REQUEST["evento"]=="modificar"){
//     $controlador->editar ($id, $arrayLesson);
// }