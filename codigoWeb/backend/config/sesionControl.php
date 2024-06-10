<?php
session_start();
if (!isset ($_SESSION["email"])){
 $_SESSION=[];
 session_destroy();
 header ("location:login.php");
 exit ();
}