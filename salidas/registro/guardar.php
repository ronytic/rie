<?php
require_once("../../login/check.php");
if(isset($_POST)){
    $CodSucursalOrigen=$_POST['CodSucursalOrigen'];
    $CodSucursalDestino=$_POST['CodSucursalDestino'];
    $pro=$_POST['p'];
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // exit();
    include_once("../../class/sucursal.php");
    $sucursal=new sucursal;
    $suc=$sucursal->mostrarTodoRegistro("CodSucursal=".$CodSucursalOrigen,1);
    $suc=array_shift($suc);
    $NombreSucursalOrigen=$suc['Nombre'];
    $suc=$sucursal->mostrarTodoRegistro("CodSucursal=".$CodSucursalDestino,1);
    $suc=array_shift($suc);
    $NombreSucursalDestino=$suc['Nombre'];
    include_once("../../class/ingreso.php");
    $ingreso=new ingreso;
    include_once("../../class/salida.php");
    $salida=new salida;

    foreach($pro as $p){

        $valores=array("CodProducto"=>"'".$p['CodProducto']."'",
                        "Cantidad"=>"'".$p['Cantidad']."'",
                        "CodSucursal"=>"'$CodSucursalDestino'",
                        "Estado"=>"'Activo'",
                        "Detalle"=>"'Traspaso de $NombreSucursalOrigen a $NombreSucursalDestino - ".$p['Detalle']."'",
                    );
        $res=$ingreso->insertarRegistro($valores);

        $valores=array("CodProducto"=>"'".$p['CodProducto']."'",
                        "Cantidad"=>"'".$p['Cantidad']."'",
                        "CodSucursal"=>"'$CodSucursalOrigen'",
                        "Estado"=>"'Activo'",
                        "Detalle"=>"'Traspaso de $NombreSucursalOrigen a $NombreSucursalDestino - ".$p['Detalle']."'",
                    );
        $res=$salida->insertarRegistro($valores);
    }
    if($res){
        $mensaje[]="El traspaso fue registrado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al registrar el traspaso";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>