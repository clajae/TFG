<?php
require_once "controllers/rolesController.php";
//pagina invisible
if (!isset ($_REQUEST["id"])){
   header('location:backend.php' );
   exit();
}
//recoger datos
$id=$_REQUEST["id"];

$controlador= new RolesController();
$borrado=$controlador->borrar ($id);