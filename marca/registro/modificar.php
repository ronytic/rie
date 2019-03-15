<?php
require_once("../../login/check.php");
$Cod=$_GET['Cod'];
include_once("../../class/marca.php");
$marca=new marca;
$mar=$marca->mostrarTodoRegistro("CodMarca=$Cod",1);
$mar=array_shift($mar);
$titulo="Modificar Datos  de marca";
$folder="../../";
?>
<?php require_once($folder."cabecerahtml.php");?>
<?php require_once($folder."cabecera.php");?>
<div class="panel">
    <div class="panel-heading"><h3></h3></div>
    <div class="panel-body">
        <form action="actualizar.php" method="post">
            <input type="hidden" name="Cod" value="<?=$Cod;?>">
            <table class="table">
                <tr>
                    <td class="text-right middle">Nombre</td>
                    <td><input type="text" name="Nombre" id="" class="form-control" required autofocus value="<?=$mar['Nombre'];?>"></td>
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
