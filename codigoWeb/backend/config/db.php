<?php
class db
{
  const HOST = "localhost:3306";
  const DBNAME = "qwawrodw_vertexBrothers_db";
  const USER = "qwawrodw_clajae";
  const PASSWORD = "*33486188mM*"; // Evidentemente adapta los valores

  static public function conexion()
  {
    $conexion = null;
    try {
      $opciones =  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
      $conexion = new PDO('mysql:host=localhost;  dbname=' .self::DBNAME,self::USER,self::PASSWORD, $opciones);
    } catch (Exception $e) {
       echo "Ocurrió algo con la base de datos: " . $e->getMessage();
      }
     return $conexion; //Es un objeto de conexion PDO
    }
}