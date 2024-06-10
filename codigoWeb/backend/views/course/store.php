<?php
require_once "controllers/coursesController.php";
//recoger datos
if (!isset ($_REQUEST["name"])){
   header('Location:backend.php?tabla=course&accion=crear' );
   exit();
}

$id= ($_REQUEST["id"])??"";//el id me servirá en editar

$arrayCourse=[    
                "id"=>$id,
                "name"=>$_REQUEST["name"],
                "duration"=>$_REQUEST["duration"],
                "num_lessons"=>$_REQUEST["num_lessons"],
                "teacher_id"=>$_REQUEST["teacher_id"],                            
                ];

//pagina invisible
$controlador= new CoursesController();

if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayCourse);
}

// if ($_REQUEST["evento"]=="modificar"){
//     $controlador->editar ($id, $arrayCourse);
// }