<?php
require_once "controllers/students_coursesController.php";
//pagina invisible
if (!isset ($_REQUEST["student_id"])){
   header('location:backend.php' );
   exit();
}
//recoger datos
$student_id=$_REQUEST["student_id"];

$controlador= new students_coursesController();
$borrado=$controlador->borrar ($student_id);