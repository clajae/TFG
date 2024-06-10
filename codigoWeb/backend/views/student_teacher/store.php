<?php
require_once "controllers/students_teachersController.php";
//recoger datos
if (!isset ($_REQUEST["student_id"])){
   header('Location:backend.php?tabla=student_teacher&accion=crear' );
   exit();
}

$id= ($_REQUEST["id"])??"";//el id me servirá en editar

$arrayStudents_Teachers=[    
                "id"=>$id,
                "student_id"=>$_REQUEST["student_id"],
                "teacher_id"=>$_REQUEST["teacher_id"],
                             
                ];

//pagina invisible
$controlador= new Students_TeachersController();

if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayStudents_Teachers);
}

// if ($_REQUEST["evento"]=="modificar"){
//     $controlador->editar ($id, $arrayStudents_Teachers);
// }