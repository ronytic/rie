<?php
include_once("../../login/check.php");
$Cod=$_POST['Cod'];
$Estado=$_POST['Estado'];
include_once("../../class/ingreso.php");
$ingreso=new ingreso;
$ingreso->actualizarRegistro(array("Estado"=>"'$Estado'"),"CodIngreso=".$Cod);
// $producto->eliminarRegistro("Codproducto=".$Cod);

?>
