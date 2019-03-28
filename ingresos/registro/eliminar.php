<?php
include_once("../../login/check.php");
$Cod=$_POST['Cod'];
include_once("../../class/ingreso.php");
$ingreso=new ingreso;
$ingreso->actualizarRegistro(array("Estado"=>"'Anulado'"),"CodIngreso=".$Cod);
// $producto->eliminarRegistro("Codproducto=".$Cod);

?>
