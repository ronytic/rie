<?php
require_once("../../login/check.php");
$Cod=$_GET['Cod'];
include_once("../../class/sucursal.php");
$sucursal=new sucursal;
$suc=$sucursal->mostrarTodoRegistro("CodSucursal=$Cod",1);
$suc=array_shift($suc);
$titulo="Modificar Datos  de Sucursal";
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
                    <td><input type="text" name="Nombre" id="" class="form-control" required autofocus value="<?=$suc['Nombre'];?>"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Dirección</td>
                    <td><input type="text" name="Direccion" id="" class="form-control" value="<?=$suc['Direccion'];?>"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Celular</td>
                    <td><input type="text" name="Celular" id="" class="form-control" value="<?=$suc['Celular'];?>"></td>
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
