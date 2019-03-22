<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $CodSucursal=$_POST['CodSucursal'];
    $pro=$_POST['p'];

    include_once("../../class/ingreso.php");
    $ingreso=new ingreso;

    foreach($pro as $p){

        $valores=array("CodProducto"=>"'".$p['CodProducto']."'",
                        "Cantidad"=>"'".$p['Cantidad']."'",
                        "CodSucursal"=>"'$CodSucursal'",
                        "Estado"=>"'Activo'",
                        "Detalle"=>"'".$p['Detalle']."'",


                    );

    $res=$ingreso->insertarRegistro($valores);
    }
    if($res){
        $mensaje[]="El ingreso fue registrado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al registrar el ingreso";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>