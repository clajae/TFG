<?php
require_once "controllers/administratorsController.php";
//pagina invisible
if (!isset ($_REQUEST["id"])){
   header('location:backend.php' );
   exit();
}
//recoger datos
$id=$_REQUEST["id"];

$controlador= new AdministratorsController();
$borrado=$controlador->borrar ($id);