<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Carnet=$_POST['Carnet'];
    $Nombres=$_POST['Nombres'];
    $Apellidos=$_POST['Apellidos'];
    $Whatsapp=$_POST['Whatsapp'];
    $Clasificacion=$_POST['Clasificacion'];
    $Direccion=$_POST['Direccion'];

    if($_FILES['Foto']['name']!=""){
        $Foto=date("Ymd_His").$_FILES['Foto']['name'];
        @copy($_FILES['Foto']['tmp_name'],"../../imagenes/clientes/".$Foto);
    }
    else{
        $Foto="";
    }
    $valores=array("Ci"=>"'$Carnet'",
                    "Nombres"=>"'$Nombres'",
                    "Apellidos"=>"'$Apellidos'",
                    "Whatsapp"=>"'$Whatsapp'",
                    "Clasificacion"=>"'$Clasificacion'",
                    "Direccion"=>"'$Direccion'",
                    "Foto"=>"'$Foto'",
                    );

    include_once("../../class/cliente.php");
    $cliente=new cliente;
    $res=$cliente->insertarRegistro($valores);
    if($res){
        $mensaje[]="La cliente fue registrado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al registrar el cliente";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>