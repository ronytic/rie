<?php
include_once("../../login/check.php");
print_r($_POST);
$l=$_POST['l'];
$CodProducto=$_POST['CodProducto'];
$Cantidad=$_POST['Cantidad'];
$Precio=$_POST['Precio'];
$Total=$_POST['Total'];
$Detalle=$_POST['Detalle'];

include_once("../../class/producto.php");
$producto=new producto;
$pro=$producto->mostrarTodoRegistro("CodProducto=".$CodProducto,1,"Nombre");
$pro=array_shift($pro);

include_once("../../class/categoria.php");
$categoria=new categoria;
$cate=$categoria->mostrarTodoRegistro("CodCategoria=".$pro['CodCategoria'],1,"Nombre");
$cat=array_shift($cate);

include_once("../../class/marca.php");
$marca=new marca;
$marc=$marca->mostrarTodoRegistro("CodMarca=".$pro['CodMarca'],1,"Nombre");
$mar=array_shift($marc);



// array_push($_SESSION['ingresos'],array("CodProducto"=>"'$CodProducto'","Cantidad"=>"'$Cantidad'","Detalle"=>"'$Detalle'"))

?>
<tr>
    <td><?=$l;?></td>
    <td>
        <span class="badge badge-danger"><?=$cat['Nombre'];?></span>
        <span class="badge badge-primary"><?=$mar['Nombre'];?></span>
        <span class="badge badge-default"><?=$pro['Nombre'];?></span>
        <?=campo("p[$l][CodProducto]","hidden",$CodProducto);?>
        <?php //$CodProducto;?>
    </td>
    <td class="der">
        <?=campo("p[$l][Cantidad]","hidden",$Cantidad);?>
        <?=$Cantidad;?>
    </td>
    <td class="der">
        <?=campo("p[$l][Precio]","hidden",$Precio);?>
        <?=$Precio;?>
    </td>
    <td class="der">
        <?=campo("p[$l][Total]","hidden",$Total);?>
        <span class="totales"><?=$Total;?></span>
    </td>
    <td>
        <?=campo("p[$l][Detalle]","hidden",$Detalle);?>
        <?=$Detalle;?>
    </td>
    <td>
        <a href="#" class="btn btn-danger btn-xs eliminarfila"><i class="fa fa-close"></i>   </a>
    </td>
</tr>