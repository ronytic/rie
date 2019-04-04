<?php
include_once("../../login/check.php");
$Cod=$_POST['Cod'];
include_once("../../class/usuario.php");
$usuario=new usuario;

$usuario->eliminarRegistro("Cod=".$Cod);

?>
