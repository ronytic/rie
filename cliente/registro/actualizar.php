<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Cod=$_POST['Cod'];
    $Carnet=$_POST['Carnet'];
    $Nombres=$_POST['Nombres'];
    $Apellidos=$_POST['Apellidos'];
    $Whatsapp=$_POST['Whatsapp'];
    $Clasificacion=$_POST['Clasificacion'];
    $Direccion=$_POST['Direccion'];




    $valores=array("Ci"=>"'$Carnet'",
                    "Nombres"=>"'$Nombres'",
                    "Apellidos"=>"'$Apellidos'",
                    "Whatsapp"=>"'$Whatsapp'",
                    "Clasificacion"=>"'$Clasificacion'",
                    "Direccion"=>"'$Direccion'",
                    );
    if(isset($_FILES['Foto']['name'])){
        if($_FILES['Foto']['name']!=""){
            $Foto=date("Ymd_His").$_FILES['Foto']['name'];
            @copy($_FILES['Foto']['tmp_name'],"../../imagenes/clientes/".$Foto);
            $valores['Foto']="'$Foto'";
        }
    }
    else{
        $Foto="";
    }
    include_once("../../class/cliente.php");
    $cliente=new cliente;
    $res=$cliente->actualizarRegistro($valores,"CodCliente=$Cod");
    if($res){
        $mensaje[]="La cliente fue modificó correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al mdificar la cliente";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>