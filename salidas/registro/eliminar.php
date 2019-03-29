<?php
include_once("../../login/check.php");
$Cod=$_POST['Cod'];
$Estado=$_POST['Estado'];
include_once("../../class/salida.php");
$salida=new salida;
$salida->actualizarRegistro(array("Estado"=>"'$Estado'"),"CodSalida=".$Cod);
// $producto->eliminarRegistro("Codproducto=".$Cod);

?>
