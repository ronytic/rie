<?php
require_once("../../login/check.php");
// print_r($_SESSION);

include_once("../../class/categoria.php");
$categoria=new categoria;
$cate=$categoria->mostrarTodoRegistro("",1,"Nombre");
$cat=todoLista($cate,"CodCategoria","Nombre");
include_once("../../class/marca.php");
$marca=new marca;
$marc=$marca->mostrarTodoRegistro("",1,"Nombre");
$mar=todoLista($marc,"CodMarca","Nombre");
$titulo="Registro de Producto";
$folder="../../";
?>
<?php require_once($folder."cabecerahtml.php");?>
<?php require_once($folder."cabecera.php");?>
<div class="panel">
    <div class="panel-heading"><h3></h3></div>
    <div class="panel-body">
        <form action="guardar.php" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td class="text-right middle" width="30%">Categoria</td>
                    <td><?=campo("CodCategoria","select",$cat,"form-control",1,"",1,array(),0,1);?></td>
                </tr>
                <tr>
                    <td class="text-right middle">Marca</td>
                    <td><?=campo("CodMarca","select",$mar,"form-control",1,"",1,array(),0,1);?></td>
                </tr>
                <tr>
                    <td class="text-right middle">Nombre</td>
                    <td><input type="text" name="Nombre" id="" class="form-control" required ></td>
                </tr>
                <tr>
                    <td class="text-right middle">Color</td>
                    <td><input type="color" name="Color" id="" class="form-control"  ></td>
                </tr>
                <tr>
                    <td class="text-right middle">Caracteristicas</td>
                    <td><textarea name="Caracteristicas" id="" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td class="text-right middle">Calidad</td>
                    <td><input type="text" name="Calidad" id="" class="form-control"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Código</td>
                    <td><input type="text" name="Codigo" id="" class="form-control"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Cantidad Mínima</td>
                    <td><input type="number" name="CantidadMinima" id="" class="form-control der" value="0" min="0"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Precio de Venta Unitario</td>
                    <td><input type="number" name="PrecioVentaUnitario" id="" class="form-control der" value="0" min="0" step="0.01" required></td>
                </tr>
                <tr>
                    <td class="text-right middle">Precio de Venta Mayor</td>
                    <td><input type="number" name="PrecioVentaMayor" id="" class="form-control der" value="0" min="0" step="0.01" required></td>
                </tr>
                <tr>
                    <td class="text-right middle">Precio de Venta Especial</td>
                    <td><input type="number" name="PrecioVentaEspecial" id="" class="form-control der" value="0" min="0" step="0.01" required></td>
                </tr>
                <tr>
                    <td class="text-right middle">Foto</td>
                    <td><input type="file" name="Foto" id="" class="form-control"></td>
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
