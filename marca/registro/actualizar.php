<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Cod=$_POST['Cod'];
    $Nombre=$_POST['Nombre'];
    $Orden=$_POST['Orden'];
    $valores=array("Nombre"=>"'$Nombre'",
                     "Orden"=>"'$Orden'",
                    );
    include_once("../../class/marca.php");
    $marca=new marca;
    $res=$marca->actualizarRegistro($valores,"CodMarca=$Cod");
    if($res){
        $mensaje[]="La marca fue modificado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al modificar la marca";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>