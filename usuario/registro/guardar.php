<?php
require_once("../../login/check.php");
if(isset($_POST)){
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
                    "Contrasena"=>"SHA1('$Contrasena')",
                    );

    include_once("../../class/usuario.php");
    $usuario=new usuario;
    // $res=$usuario->insertarRegistro($valores);
    if($res){
        $mensaje[]="El usuario fue registrado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al registrar el usuario";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>