<?php
include_once("../../login/check.php");
$Cod=$_POST['Cod'];
include_once("../../class/producto.php");
$producto=new producto;

$producto->eliminarRegistro("Codproducto=".$Cod);

?>
