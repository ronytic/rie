<?php
$host="localhost";
$user="root";
$pass="";
$database="riebd";
$puerto="3306";

/*$host="pdb31.awardspace.net";
$user="2905970_sistemas";
$pass="Dewin71248484";
$database="2905970_sistemas";*/



/*Configuración de Idioma del Sistema*/
date_default_timezone_set('America/La_Paz');
setlocale(LC_CTYPE, "es_ES");
setlocale(LC_ALL, 'sp');
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

/*Configuración de las Tablas a Exportar*/
$tables_export=array();
$tablas_optimizar=array("logusuario");
?>
