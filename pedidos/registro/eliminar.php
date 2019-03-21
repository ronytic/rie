<?php
include_once("../../login/check.php");
$Cod=$_POST['Cod'];
include_once("../../class/pedido.php");
$pedido=new pedido;

$pedido->eliminarRegistro("Codpedido=".$Cod);

?>
