<?php
include_once("../../login/check.php");
$Cod=$_POST['Cod'];
include_once("../../class/cliente.php");
$cliente=new cliente;

$cliente->eliminarRegistro("CodCliente=".$Cod);

?>
