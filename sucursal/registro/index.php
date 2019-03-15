<?php
require_once("../../login/check.php");
// print_r($_SESSION);
$titulo="Registro de Sucursal";
$folder="../../";
?>
<?php require_once($folder."cabecerahtml.php");?>
<?php require_once($folder."cabecera.php");?>
<div class="panel">
    <div class="panel-heading"><h3>Registro</h3></div>
    <div class="panel-body">
        <form action="guardar.php" method="post">
            <table class="table">
                <tr>
                    <td class="text-right middle">Nombre</td>
                    <td><input type="text" name="Nombre" id="" class="form-control" required autofocus></td>
                </tr>
                <tr>
                    <td class="text-right middle">Dirección</td>
                    <td><input type="text" name="Direccion" id="" class="form-control"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Celular</td>
                    <td><input type="text" name="Celular" id="" class="form-control"></td>
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
