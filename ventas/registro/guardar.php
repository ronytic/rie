<?php
require_once("../../login/check.php");
if(isset($_POST)){

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    require_once("../../class/venta.php");
    $venta=new venta;
    require_once("../../class/salida.php");
    $salida=new salida;
    require_once("../../class/cliente.php");
    $cliente=new cliente;
    require_once("../../class/sucursal.php");
    $sucursal=new sucursal;


    $CodSucursal=$_POST['CodSucursal'];
    $CodCliente=$_POST['CodCliente'];
    $p=$_POST['p'];
    $TotalGeneral=$_POST['TotalGeneral'];
    $Cancelado=$_POST['Cancelado'];
    $Cambio=$_POST['Cambio'];

    $cli=$cliente->mostrarTodoRegistro("CodCliente=".$CodCliente);
    $cli=array_shift($cli);

    $suc=$sucursal->mostrarTodoRegistro("CodSucursal=".$CodSucursal);
    $suc=array_shift($suc);

    $valores=array("CodSucursal"=>"'$CodSucursal'",
                        "CodCliente"=>"'$CodCliente'",
                        "TotalGeneral"=>"'$TotalGeneral'",
                        "Cancelado"=>"'$Cancelado'",
                        "Cambio"=>"'$Cambio'",
                    );

$res=$venta->insertarRegistro($valores);
$CodVenta=$venta->ultimo();
echo $CodVenta;
    foreach ($p as $pro) {
        $val=array("CodVenta"=>"'$CodVenta'",
                        "CodProducto"=>"'".$pro['CodProducto']."'",
                        "Cantidad"=>"'".$pro['Cantidad']."'",
                        "Precio"=>"'".$pro['Precio']."'",
                        "Total"=>"'".$pro['Total']."'",
                        "Detalle"=>"'Venta de ".$cli['Nombres'].' '.$cli['Apellidos'].", Suc: ".$suc['Nombre']." - ".$pro['Detalle']."'",
                        "Estado"=>"'Activo'",
                    );
        $salida->insertarRegistro($val);
    }
    if($res){
        $mensaje[]="La Venta fue registrado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al Registrar la Venta";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>
