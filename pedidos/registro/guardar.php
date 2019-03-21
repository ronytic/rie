<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $CodSucursal=$_POST['CodSucursal'];
    $CodCategoria=$_POST['CodCategoria'];
    $Marca=$_POST['Marca'];
    $Nombre=$_POST['Nombre'];
    $Detalle=$_POST['Detalle'];
    $NroPedido=$_POST['NroPedido'];
    $FechaPedido=$_POST['FechaPedido'];
    $FechaEntrega=$_POST['FechaEntrega'];

    $valores=array("CodSucursal"=>"'$CodSucursal'",
                    "CodCategoria"=>"'$CodCategoria'",
                    "Marca"=>"'$Marca'",
                    "Nombre"=>"'$Nombre'",
                    "Detalle"=>"'$Detalle'",
                    "NroPedido"=>"'$NroPedido'",
                    "FechaPedido"=>"'$FechaPedido'",
                    "FechaEntrega"=>"'$FechaEntrega'",
                    );

    include_once("../../class/pedido.php");
    $pedido=new pedido;
    $res=$pedido->insertarRegistro($valores);
    if($res){
        $mensaje[]="El pedido fue registrado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al registrar el pedido";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>