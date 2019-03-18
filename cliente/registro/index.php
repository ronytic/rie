<?php
require_once("../../login/check.php");
// print_r($_SESSION);

$titulo="Registro de Cliente";
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
                    <td class="text-right middle">Carnet</td>
                    <td><input type="text" name="Carnet" id="" class="form-control" required autofocus></td>
                </tr>
                <tr>
                    <td class="text-right middle">Nombres</td>
                    <td><input type="text" name="Nombres" id="" class="form-control" required ></td>
                </tr>
                <tr>
                    <td class="text-right middle">Apellidos</td>
                    <td><input type="text" name="Apellidos" id="" class="form-control" required ></td>
                </tr>
                <tr>
                    <td class="text-right middle">Whatsapp</td>
                    <td><input type="text" name="Whatsapp" id="" class="form-control" required ></td>
                </tr>
                <tr>
                    <td class="text-right middle">Clasificación</td>
                    <td>
                        <select name="Clasificacion" class="form-control">
                            <option value="unitario">Unitario</option>
                            <option value="mayor">Mayor</option>
                            <option value="especial">Especial</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="text-right middle">Dirección</td>
                    <td><textarea name="Direccion" id="" class="form-control"></textarea></td>
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
