<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $Cod=$_POST['Cod'];
    $CodSucursal=$_POST['CodSucursal'];
    $NivelAcceso=$_POST['NivelAcceso'];
    $Nombres=$_POST['Nombres'];
    $Apellidos=$_POST['Apellidos'];
    $Ci=$_POST['Ci'];
    $Usuario=$_POST['Usuario'];
    $Contrasena=$_POST['Contrasena'];




    @$valores=array("CodSucursal"=>"'$CodSucursal'",
                    "NivelAcceso"=>"'$NivelAcceso'",
                    "Nombres"=>"'$Nombres'",
                    "Apellidos"=>"'$Apellidos'",

                    "Ci"=>"'$Ci'",
                    "Usuario"=>"'$Usuario'",

                    );

    if($Contrasena!=""){
        $valores["Contrasena"]="SHA1('$Contrasena')";
    }

    include_once("../../class/usuario.php");
    $usuario=new usuario;
    $res=$usuario->actualizarRegistro($valores,"Cod=$Cod");
    if($res){
        $mensaje[]="El usuario fue modificado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al modificar la usuario";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>