<?php
require_once("../../login/check.php");
$CodProducto=$_POST['CodProducto'];
$CodSucursal=$_POST['CodSucursal'];
$CodCliente=$_POST['CodCliente'];

require_once("../../class/stock.php");
$stock=new stock;
$s=$stock->obtener($CodProducto,$CodSucursal);
$s=array_shift($s);
$datos['stock']=$s['Stock'];

require_once("../../class/cliente.php");
$cliente=new cliente;
$cli=$cliente->mostrarTodoRegistro("CodCliente=".$CodCliente);
$cli=array_shift($cli);
$Clasificacion=$cli['Clasificacion'];

require_once("../../class/producto.php");
$producto=new producto;
$pro=$producto->mostrarTodoRegistro("CodProducto=".$CodProducto);
$pro=array_shift($pro);
$datos['precio']=$pro['PrecioVenta'.ucwords($Clasificacion)];
$datos['Color']=$pro['Color'];
$datos['Caracteristicas']=$pro['Caracteristicas'];
$datos['Calidad']=$pro['Calidad'];
$datos['Codigo']=$pro['Codigo'];
$datos['Foto']=$pro['Foto'];
echo json_encode($datos);
?>