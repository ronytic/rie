<?php
// No Utilizado
require_once("../../login/check.php");
$Cod=$_GET['Cod'];

include_once("../../class/categoria.php");
$categoria=new categoria;
$cate=$categoria->mostrarTodoRegistro("",1,"Nombre");
$cat=todoLista($cate,"CodCategoria","Nombre");
include_once("../../class/marca.php");
$marca=new marca;
$marc=$marca->mostrarTodoRegistro("",1,"Nombre");
$mar=todoLista($marc,"CodMarca","Nombre");


include_once("../../class/producto.php");
$producto=new producto;
$pro=$producto->mostrarTodoRegistro("CodProducto=$Cod",1);
$pro=array_shift($pro);
$titulo="Modificar Datos de producto";
$folder="../../";
?>
<?php require_once($folder."cabecerahtml.php");?>
<?php require_once($folder."cabecera.php");?>
<div class="panel">
    <div class="panel-heading"><h3></h3></div>
    <div class="panel-body">
        <form action="actualizar.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="Cod" value="<?=$Cod;?>">
            <table class="table">
                <tr>
                    <td class="text-right middle" width="30%">Categoria</td>
                    <td><?=campo("CodCategoria","select",$cat,"form-control",1,"",1,array(),$pro['CodCategoria'],1);?></td>
                </tr>
                <tr>
                    <td class="text-right middle">Marca</td>
                    <td><?=campo("CodMarca","select",$mar,"form-control",1,"",1,array(),$pro['CodMarca'],1);?></td>
                </tr>
                <tr>
                    <td class="text-right middle">Nombre</td>
                    <td><input type="text" name="Nombre" id="" class="form-control" required value="<?=$pro['Nombre'];?>"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Color</td>
                    <td><input type="color" name="Color" id="" class="form-control"  value="<?=$pro['Color'];?>"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Caracteristicas</td>
                    <td><textarea name="Caracteristicas" id="" class="form-control"><?=$pro['Caracteristicas'];?></textarea></td>
                </tr>
                <tr>
                    <td class="text-right middle">Calidad</td>
                    <td><input type="text" name="Calidad" id="" class="form-control" value="<?=$pro['Calidad'];?>"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Código</td>
                    <td><input type="text" name="Codigo" id="" class="form-control" value="<?=$pro['Codigo'];?>"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Cantidad Mínima</td>
                    <td><input type="number" name="CantidadMinima" id="" class="form-control der" value="<?=$pro['CantidadMinima'];?>" min="0"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Precio de Venta Unitario</td>
                    <td><input type="number" name="PrecioVentaUnitario" id="" class="form-control der" value="<?=$pro['PrecioVentaUnitario'];?>" min="0" step="0.01" required></td>
                </tr>
                <tr>
                    <td class="text-right middle">Precio de Venta Mayor</td>
                    <td><input type="number" name="PrecioVentaMayor" id="" class="form-control der" value="<?=$pro['PrecioVentaMayor'];?>" min="0" step="0.01" required></td>
                </tr>
                <tr>
                    <td class="text-right middle">Precio de Venta Especial</td>
                    <td><input type="number" name="PrecioVentaEspecial" id="" class="form-control der" value="<?=$pro['PrecioVentaEspecial'];?>" min="0" step="0.01" required></td>
                </tr>
                <tr>
                    <td class="text-right middle">Foto</td>
                    <td><input type="file" name="Foto" id="" class="form-control">
                    <?php
                    $url="../../imagenes/productos/".$pro['Foto'];
                    if(file_exists($url)){
                    ?>
                    <a href="<?php echo $url?>" class="btn" target="_blank">
                        <img src="<?php echo $url?>" alt="" class="img-thumbnail">
                    </a>
                    <?php
                       }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="middle"><input type="submit" value="Guardar" class="btn btn-primary"></td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php require_once($folder."pie.php");?>
