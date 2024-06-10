<?php
require_once "controllers/studentsController.php";
//pagina invisible
if (!isset ($_REQUEST["id"])){
   header('location:backend.php' );
   exit();
}
//recoger datos
$id=$_REQUEST["id"];

$controlador= new StudentsController();
$borrado=$controlador->borrar ($id);