<?php
include_once("../../login/check.php");
$Cod=$_POST['Cod'];
include_once("../../class/marca.php");
$marca=new marca;

$marca->eliminarRegistro("CodMarca=".$Cod);

?>
