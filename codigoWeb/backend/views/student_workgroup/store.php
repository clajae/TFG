<?php
require_once "controllers/students_workgroupsController.php";
//recoger datos
if (!isset ($_REQUEST["student_id"])){
   header('Location:backend.php?tabla=student_workgroup&accion=crear' );
   exit();
}

$id= ($_REQUEST["id"])??"";//el id me servirá en editar

$arrayStudents_Workgroups=[    
                "id"=>$id,
                "student_id"=>$_REQUEST["student_id"],
                "work_group_id"=>$_REQUEST["work_group_id"],
                             
                ];

//pagina invisible
$controlador= new Students_WorkgroupsController();

if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayStudents_Workgroups);
}

// if ($_REQUEST["evento"]=="modificar"){
//     $controlador->editar ($id, $arrayStudents_Workgroups);
// }