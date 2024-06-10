<?php
require_once "controllers/teachersController.php";
//pagina invisible
if (!isset ($_REQUEST["id"])){
   header('location:backend.php' );
   exit();
}
//recoger datos
$id=$_REQUEST["id"];

$controlador= new TeachersController();
$borrado=$controlador->borrar ($id);