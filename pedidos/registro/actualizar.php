<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Cod=$_POST['Cod'];
    $CodSucursal=$_POST['CodSucursal'];
    $CodCategoria=$_POST['CodCategoria'];
    $Marca=$_POST['Marca'];
    $Nombre=$_POST['Nombre'];
    $Detalle=$_POST['Detalle'];
    $NroPedido=$_POST['NroPedido'];
    $FechaPedido=$_POST['FechaPedido'];
    $FechaEntrega=$_POST['FechaEntrega'];
    $Estado=$_POST['Estado'];




    $valores=array("CodSucursal"=>"'$CodSucursal'",
                    "CodCategoria"=>"'$CodCategoria'",
                    "Marca"=>"'$Marca'",
                    "Nombre"=>"'$Nombre'",
                    "Detalle"=>"'$Detalle'",
                    "NroPedido"=>"'$NroPedido'",
                    "FechaPedido"=>"'$FechaPedido'",
                    "FechaEntrega"=>"'$FechaEntrega'",
                    "Estado"=>"'$Estado'",
                    );

    include_once("../../class/pedido.php");
    $pedido=new pedido;
    $res=$pedido->actualizarRegistro($valores,"Codpedido=$Cod");
    if($res){
        $mensaje[]="El pedido fue modificado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al modificar la pedido";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>