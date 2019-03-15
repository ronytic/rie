<?php
include_once("../../login/check.php");
$Cod=$_POST['Cod'];
include_once("../../class/categoria.php");
$categoria=new categoria;

$categoria->eliminarRegistro("CodCategoria=".$Cod);

?>
