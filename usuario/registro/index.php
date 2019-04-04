<?php
require_once("../../login/check.php");
// print_r($_SESSION);

$NivelAcceso=array("");

include_once("../../class/sucursal.php");
$sucursal=new sucursal;
$suc=$sucursal->mostrarTodoRegistro("",1,"Nombre");
$suc=todoLista($suc,"CodSucursal","Nombre");
$suc=array_unshift_assoc($suc,"%","Todos");


include_once("../../class/acceso.php");
$acceso=new acceso;
$acc=$acceso->mostrarTodoRegistro("Visible=1",1,"Nombre");
$acc=todoLista($acc,"CodAcceso","Nombre");

$titulo="Registro de Nuevo Usuario";
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
                    <td class="text-right middle" width="30%">Sucursal a Administrar</td>
                    <td><?=campo("CodSucursal","select",$suc,"form-control",1,"",1,array());?></td>
                </tr>
                <tr>
                    <td class="text-right middle">Nivel de Acceso</td>
                    <td><?=campo("NivelAcceso","select",$acc,"form-control",1,"",1,array(),0,1);?></td>
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
                    <td class="text-right middle">Carnet</td>
                    <td><input type="text" name="Ci" id="" class="form-control" required ></td>
                </tr>
                <tr>
                    <td colspan="2"><div class="alert alert-info text-center">Debe Introducir un usuario en minúsculas, sin espacios y sin números</div></td>
                </tr>
                <tr>
                    <td class="text-right middle">Usuario</td>
                    <td><input type="text" name="Usuario" id="" class="form-control" required ></td>
                </tr>
                <tr>
                    <td class="text-right middle">Contraseña</td>
                    <td><input type="password" name="Contrasena" id="" class="form-control"  ></td>
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
