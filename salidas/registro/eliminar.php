<?php
include_once("../../login/check.php");
$Cod=$_POST['Cod'];
include_once("../../class/salida.php");
$salida=new salida;
$salida->actualizarRegistro(array("Estado"=>"'Anulado'"),"CodSalida=".$Cod);
// $producto->eliminarRegistro("Codproducto=".$Cod);

?>
