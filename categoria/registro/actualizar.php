<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Cod=$_POST['Cod'];
    $Nombre=$_POST['Nombre'];
    $Orden=$_POST['Orden'];
    $valores=array("Nombre"=>"'$Nombre'",
                    "Orden"=>"'$Orden'",
                    );
    include_once("../../class/categoria.php");
    $categoria=new categoria;
    $res=$categoria->actualizarRegistro($valores,"CodCategoria=$Cod");
    if($res){
        $mensaje[]="La categoria fue modificado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al modificar la categoria";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>