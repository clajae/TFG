<?php
require_once "controllers/workgroupsController.php";
//pagina invisible
if (!isset ($_REQUEST["id"])){
   header('location:backend.php' );
   exit();
}
//recoger datos
$id=$_REQUEST["id"];

$controlador= new workgroupsController();
$borrado=$controlador->borrar ($id);