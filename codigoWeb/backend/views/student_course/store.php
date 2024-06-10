<?php
require_once "controllers/students_coursesController.php";
//recoger datos
if (!isset ($_REQUEST["student_id"])){
   header('Location:backend.php?tabla=student_course&accion=crear' );
   exit();
}

$id= ($_REQUEST["id"])??"";//el id me servirá en editar

$arrayStudent_Course=[    
                "id"=>$id,
                "student_id"=>$_REQUEST["student_id"],
                "course_id"=>$_REQUEST["course_id"],                         
                ];

//pagina invisible
$controlador= new Students_CoursesController();

if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayStudent_Course);
}

// if ($_REQUEST["evento"]=="modificar"){
//     $controlador->editar ($id, $arrayStudent_Course);
// }