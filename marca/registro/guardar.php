<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Nombre=$_POST['Nombre'];
    $valores=array("Nombre"=>"'$Nombre'",
                    );
    include_once("../../class/marca.php");
    $marca=new marca;
    $res=$marca->insertarRegistro($valores);
    if($res){
        $mensaje[]="La marca fue registrado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al registrar la marca";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>