<?php
require_once("../../login/check.php");
$CodProducto=$_POST['CodProducto'];
$CodSucursalOrigen=$_POST['CodSucursalOrigen'];

require_once("../../class/stock.php");
$stock=new stock;
$s=$stock->obtener($CodProducto,$CodSucursalOrigen);
$s=array_shift($s);
echo $s['Stock'];
// print_r($sal);
?>