<?php
require_once "controllers/lessonsController.php";
//pagina invisible
if (!isset ($_REQUEST["id"])){
   header('location:backend.php' );
   exit();
}
//recoger datos
$id=$_REQUEST["id"];

$controlador= new LessonsController();
$borrado=$controlador->borrar ($id);