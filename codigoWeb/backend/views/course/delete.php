<?php
require_once "controllers/coursesController.php";
//pagina invisible
if (!isset ($_REQUEST["id"])){
   header('location:backend.php' );
   exit();
}
//recoger datos
$id=$_REQUEST["id"];

$controlador= new CoursesController();
$borrado=$controlador->borrar ($id);