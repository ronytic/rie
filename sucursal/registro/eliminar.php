<?php
include_once("../../login/check.php");
$Cod=$_POST['Cod'];
include_once("../../class/sucursal.php");
$sucursal=new sucursal;

$sucursal->eliminarRegistro("CodSucursal=".$Cod);

?>
