<?php
require_once "controllers/usersController.php";
//pagina invisible
if (!isset ($_REQUEST["id"])){
   header('location:backend.php' );
   exit();
}
//recoger datos
$id=$_REQUEST["id"];

$controlador= new UsersController();
$borrado=$controlador->borrar ($id);