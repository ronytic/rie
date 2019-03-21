<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Cod=$_POST['Cod'];
    $Nombre=$_POST['Nombre'];
    $Direccion=$_POST['Direccion'];
    $Celular=$_POST['Celular'];
    $valores=array("Nombre"=>"'$Nombre'",
                    "Direccion"=>"'$Direccion'",
                    "Celular"=>"'$Celular'"
                    );
    include_once("../../class/sucursal.php");
    $sucursal=new sucursal;
    $res=$sucursal->actualizarRegistro($valores,"CodSucursal=$Cod");
    if($res){
        $mensaje[]="La Sucursal fue modificado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al Modificar la Sucursal";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>