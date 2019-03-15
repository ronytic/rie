<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Nombre=$_POST['Nombre'];
    $Direccion=$_POST['Direccion'];
    $Celular=$_POST['Celular'];
    $valores=array("Nombre"=>"'$Nombre'",
                    "Direccion"=>"'$Direccion'",
                    "Celular"=>"'$Celular'"
                    );
    include_once("../../class/sucursal.php");
    $sucursal=new sucursal;
    $res=$sucursal->insertarRegistro($valores);
    if($res){
        $mensaje[]="La Sucursal fue registrado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al Registrar la Sucursal";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>