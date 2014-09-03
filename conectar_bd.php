<?php

$conexion;
function conectar_bd()
{
    global $conexion;
    //Definir datos de conexion con el servidor MySQL
    $elUsr = "root";
    $elPw  = "getecsa"; 
    $elServer ="localhost";
    $laBd = "sis_fac";
     
    //Conectar
    $conexion = mysql_connect($elServer, $elUsr , $elPw) or die (mysql_error());
     
    //Seleccionar la BD a utilizar
    mysql_select_db($laBd, $conexion ) or die (mysql_error());
}   
?>