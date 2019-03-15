<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Nombre=$_POST['Nombre'];
    $valores=array("Nombre"=>"'$Nombre'",
                    );
    include_once("../../class/categoria.php");
    $categoria=new categoria;
    $res=$categoria->insertarRegistro($valores);
    if($res){
        $mensaje[]="La categoria fue registrado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al registrar la categoria";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>