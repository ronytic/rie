<?php
require_once("../../login/check.php");
$Cod=$_GET['Cod'];


$cla=array("unitario"=>"Unitario","mayor"=>"Mayor","especial"=>"Especial");

include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=$cliente->mostrarTodoRegistro("CodCliente=$Cod",1);
$cli=array_shift($cli);
$titulo="Modificar Datos de Cliente";
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
                    <td class="text-right middle" width="30%">Carnet</td>
                    <td><input type="text" name="Carnet" id="" class="form-control" value="<?=$cli['Ci'];?>" required autofocus></td>
                </tr>
                <tr>
                    <td class="text-right middle">Nombres</td>
                    <td><input type="text" name="Nombres" id="" class="form-control" value="<?=$cli['Nombres'];?>" required ></td>
                </tr>
                <tr>
                    <td class="text-right middle">Apellidos</td>
                    <td><input type="text" name="Apellidos" id="" class="form-control" value="<?=$cli['Apellidos'];?>" required ></td>
                </tr>
                <tr>
                    <td class="text-right middle">Whatsapp</td>
                    <td><input type="text" name="Whatsapp" id="" class="form-control" value="<?=$cli['Whatsapp'];?>" required ></td>
                </tr>
                <tr>
                    <td class="text-right middle">Clasificación</td>
                    <td><?=campo("Clasificacion","select",$cla,"form-control",1,"",1,array(),$cli['Clasificacion'],0);?></td>
                </tr>
                <tr>
                    <td class="text-right middle">Dirección</td>
                    <td><textarea name="Direccion" id="" class="form-control"><?=$cli['Direccion'];?></textarea></td>
                </tr>
                <tr>
                    <td class="text-right middle">Foto</td>
                    <td><input type="file" name="Foto" id="" class="form-control">
                    <?php
                    $url="../../imagenes/clientes/".$cli['Foto'];
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
