<?php
require_once("../../login/check.php");
$Cod=$_GET['Cod'];

include_once("../../class/sucursal.php");
$sucursal=new sucursal;
$suc=$sucursal->mostrarTodoRegistro("",1,"Nombre");
$suc=todoLista($suc,"CodSucursal","Nombre");

include_once("../../class/categoria.php");
$categoria=new categoria;
$cate=$categoria->mostrarTodoRegistro("",1,"Nombre");
$cat=todoLista($cate,"CodCategoria","Nombre");
include_once("../../class/marca.php");
$marca=new marca;
$marc=$marca->mostrarTodoRegistro("",1,"Nombre");
$mar=todoLista($marc,"CodMarca","Nombre");


include_once("../../class/pedido.php");
$pedido=new pedido;
$pe=$pedido->mostrarTodoRegistro("CodPedido=$Cod",1);
$pe=array_shift($pe);

$est=array("0"=>"No Entregado","1"=>"Entregado");

$titulo="Modificar Datos del Pedido";
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
                    <td class="text-right middle" width="30%">Sucursal</td>
                    <td>
                        <?php
                        if(!in_array( $_SESSION['NivelAcceso'],array(1,2))){
                            $val="disabled";
                            echo campo("CodSucursal","hidden",$_SESSION['CodSucursal']);
                        }else{
                            $val="";
                        }
                        ?>
                        <?=campo("CodSucursal","select",$suc,"form-control",1,"",0,array($val=>$val),$pe['CodSucursal'],0);?>

                    </td>
                </tr>
                <tr>
                    <td class="text-right middle" width="30%">Categoria</td>
                    <td><?=campo("CodCategoria","select",$cat,"form-control",1,"",1,array(),$pe['CodCategoria'],1);?></td>
                </tr>
                <tr>
                    <td class="text-right middle">Marca</td>
                    <td>
                        <input type="text" name="Marca" id="" class="form-control" required list="lista" value="<?=$pe['Marca'];?>">
                        <datalist id="lista">
                            <?php
                            foreach ($mar as $m) {
                                ?>
                                <option value="<?=$m;?>"><?=$m;?></option>
                                <?php
                            }
                            ?>
                        </datalist>
                    </td>
                </tr>
                <tr>
                    <td class="text-right middle">Nombre de Pieza Pedido</td>
                    <td><input type="text" name="Nombre" id="" class="form-control" required value="<?=$pe['Nombre'];?>"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Detalle</td>
                    <td><textarea name="Detalle" id="" class="form-control"><?=$pe['Detalle'];?></textarea></td>
                </tr>
                <tr>
                    <td class="text-right middle">Nro de Solicitud/Pedido</td>
                    <td><input type="text" name="NroPedido" id="" class="form-control" value="<?=$pe['NroPedido'];?>"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Fecha de Pedido</td>
                    <td><input type="date" name="FechaPedido" id="" class="form-control"  readonly value="<?php echo fecha2Str($pe['FechaPedido'],0)?>"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Fecha de Entrega</td>
                    <td><input type="date" name="FechaEntrega" id="" class="form-control"   value="<?php echo fecha2Str($pe['FechaEntrega'],0)?>"></td>
                </tr>
                <tr>
                    <td class="text-right middle">Estado</td>
                    <td><?=campo("Estado","select",$est,"form-control",1,"",1,array(),$pe['Estado'],0);?></td>
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
