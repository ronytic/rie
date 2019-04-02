<?php
include_once("../../login/check.php");
$Cod=$_POST['Cod'];
$Estado=$_POST['Estado'];
include_once("../../class/venta.php");
$venta=new venta;
$venta->actualizarRegistro(array("Estado"=>"'$Estado'"),"CodVenta=".$Cod);


include_once("../../class/salida.php");
$salida=new salida;
$salida->actualizarRegistro(array("Estado"=>"'$Estado'"),"CodVenta=".$Cod);
// $producto->eliminarRegistro("Codproducto=".$Cod);

?>
