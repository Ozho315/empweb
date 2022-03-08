<?php
//Conexion con bdd
$host="localhost";
$bdd="emprendimiento";
$usuario="root";
$contrasena="";

//Comprobar coneccion
try {
    $conexion=new PDO("mysql:host=$host;dbname=$bdd",$usuario,$contrasena);
    } catch (Exception $ex) {
echo $ex->getMessage();
}

?>