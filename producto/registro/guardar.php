<?php
require_once("../../login/check.php");
if(isset($_POST)){
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
    $Lista=$_POST['Lista'];

    if(isset($_FILES['Foto']['name'])){
        if($_FILES['Foto']['name']!=""){
        $Foto=date("Ymd_His").$_FILES['Foto']['name'];
        @copy($_FILES['Foto']['tmp_name'],"../../imagenes/productos/".$Foto);
        }
    }
    else{
        $Foto="";
    }
    @$valores=array("Nombre"=>"'$Nombre'",
                    "Color"=>"'$Color'",
                    "Caracteristicas"=>"'$Caracteristicas'",
                    "Calidad"=>"'$Calidad'",
                    "Codigo"=>"'$Codigo'",
                    "CantidadMinima"=>"'$CantidadMinima'",
                    "PrecioVentaUnitario"=>"'$PrecioVentaUnitario'",
                    "PrecioVentaMayor"=>"'$PrecioVentaMayor'",
                    "PrecioVentaEspecial"=>"'$PrecioVentaEspecial'",
                    "Foto"=>"'$Foto'",
                    "CodCategoria"=>"'$CodCategoria'",
                    "CodMarca"=>"'$CodMarca'",
                    "Lista"=>"'$Lista'",
                    );

    include_once("../../class/producto.php");
    $producto=new producto;
    $res=$producto->insertarRegistro($valores);
    if($res){
        $mensaje[]="El producto fue registrado correctamente";
        $tipomensaje="success";
    }else{
        $mensaje[]="Error al registrar el producto";
        $tipomensaje="danger";
    }
    include_once("mensaje.php");
}
?>