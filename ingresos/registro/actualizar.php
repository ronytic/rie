<?php
// No Utilizado
require_once("../../login/check.php");
if(isset($_POST)){
    $Cod=$_POST['Cod'];
    $CodCategoria=$_POST['CodCategoria'];
    $CodMarca=$_POST['CodMarca'];
    $Nombre=$_POST['Nombre'];
    $Color=$_POST['Color'];
    $Caracteristicas=$_POST['Caracteristicas'];
    $Calidad=$_POST['Calidad'];
    $Codigo=$_POST['Codigo'];
    $CantidadMinima=$_POST['CantidadMinima'];
    $PrecioVentaUnitario=$_POST['PrecioVentaUnitario'];
    $PrecioVentaMayor=$_POST['PrecioVentaMayor'];
    $PrecioVentaEspecial=$_POST['PrecioVentaEspecial'];




    $valores=array("Nombre"=>"'$Nombre'",
                    "Color"=>"'$Color'",
                    "Caracteristicas"=>"'$Caracteristicas'",
                    "Calidad"=>"'$Calidad'",
                    "Codigo"=>"'$Codigo'",
                    "CantidadMinima"=>"'$CantidadMinima'",
                    "PrecioVentaUnitario"=>"'$PrecioVentaUnitario'",
                    "PrecioVentaMayor"=>"'$PrecioVentaMayor'",
                    "PrecioVentaEspecial"=>"'$PrecioVentaEspecial'",

                    "CodCategoria"=>"'$CodCategoria'",
                    "CodMarca"=>"'$CodMarca'",
                    );
    if(isset($_FILES['Foto']['name'])){
        if($_FILES['Foto']['name']!=""){
        $Foto=date("Ymd_His").$_FILES['Foto']['name'];
        @copy($_FILES['Foto']['tmp_name'],"../../imagenes/productos/".$Foto);
        $valores['Foto']="'$Foto'";
        }
    }
    else{
        $Foto="";
    }
    include_once("../../class/producto.php");
    $producto=new producto;
    $res=$producto->actualizarRegistro($valores,"CodProducto=$Cod");
    if($res){
        $mensaje[]="El producto fue modificado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al modificar la producto";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>