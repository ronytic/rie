<?php
require_once("../../login/check.php");

$Cod=$_GET['Cod'];
include_once("../../class/venta.php");
$venta=new venta;
$ven=$venta->mostrarTodoRegistro("CodVenta=$Cod",1,"");
$ven=array_shift($ven);

include_once("../../class/salida.php");
$salida=new salida;
$sal=$salida->mostrarTodoRegistro("CodVenta=$Cod",1,"");

include_once("../../class/sucursal.php");
$sucursal=new sucursal;
$suc=$sucursal->mostrarTodoRegistro("CodSucursal=".$ven['CodSucursal'],1,"Nombre");
$suc=array_shift($suc);

include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=$cliente->mostrarTodoRegistro("CodCliente=".$ven['CodCliente'],1,"Apellidos,Nombres");
$cli=array_shift($cli);

include_once("../../class/producto.php");
$producto=new producto;

include_once("../../class/categoria.php");
$categoria=new categoria;

include_once("../../class/marca.php");
$marca=new marca;

$titulo="Reporte de Venta";
$folder="../../";
?>
<?php require_once($folder."cabecerahtml.php");?>

<script>
    let l=0;
    $(document).ready(function(){

    });
</script>
<style type="text/css">
#cuadrostock{
    top:0;
    left:0;
    position:absolute;
}
</style>
<?php require_once($folder."cabecera.php");?>
<div class="panel">
    <div class="panel-heading"><h3></h3></div>
    <div class="panel-body">
            <a href="listar.php" class="btn btn-default btn-xs" >Atras</a>
            <table class="table  table-condensed ">
                <tbody >
                    <tr>
                        <td class="der resaltar" width="30%">Cliente</td>
                        <td class=""><span class="badge badge-danger"><?php echo capitalizar($cli['Nombres']." ".$cli['Apellidos']." - ".$cli['Ci'])?></span></td>
                    </tr>
                    <tr>
                        <td class="der resaltar">Sucursal</td>
                        <td class=""><span class="badge badge-default"><?php echo capitalizar($suc['Nombre'])?></span></td>
                    </tr>
                    <tr>
                        <td class="der resaltar">Estado</td>
                        <td class=""><span class="badge badge-default"><?php echo capitalizar($ven['Estado'])?></span></td>
                    </tr>
                    <tr>
                        <td class="der resaltar">Detalle</td>
                        <td class=""><span class="badge badge-default"><?php echo capitalizar($ven['Detalle'])?></span></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div id="listado" class="table-">
            <table class="table table-bordered table-hover ">
                <thead>
                    <tr>
                        <th width="10" style="width:10px !important;">N</th>
                        <th>Producto</th>
                        <th width="50">Cantidad</th>
                        <th width="50">Precio</th>
                        <th width="50">Total</th>

                        <th width="">Detalle</th>
                    </tr>
                </thead>
                <tbody id="marca">
                    <?php
                        $i=0;
                        foreach ($sal as $s) {$i++;
                            $pro=$producto->mostrarTodoRegistro("CodProducto=".$s['CodProducto']);
                            $pro=array_shift($pro);

                            $cate=$categoria->mostrarTodoRegistro("CodCategoria=".$pro['CodCategoria'],1,"Nombre");
                            $cat=array_shift($cate);

                            $marc=$marca->mostrarTodoRegistro("CodMarca=".$pro['CodMarca'],1,"Nombre");
                            $mar=array_shift($marc);
                            ?>
                            <tr>
                                <td class="der"><?=$i;?></td>
                                <td>
                                    <span class="badge badge-danger"><?=$cat['Nombre'];?></span>
                                    <span class="badge badge-info"><?=$mar['Nombre'];?></span>
                                    <span class="badge badge-default"><?=$pro['Nombre'];?></span>
                                    <br>
                                    <br>
                                    <div class="alert alert-info" style="padding:5px !important"><strong>Estado:  <?=$s['Estado'];?></strong></div>

                                </td>
                                <td class="der"><?=$s['Cantidad'];?></td>
                                <td class="der"><?=num($s['Precio']);?></td>
                                <td class="der resaltar"><?=num($s['Total']);?></td>
                                <td class=""><?=$s['Detalle'];?></td>

                            </tr>
                            <?php
                        }
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" rowspan="3">
                        </th>
                        <th colspan="2" class="der">
                        Total
                        </th>
                        <th class="der">
                        <span class="badge badge-danger"><?=num($ven['TotalGeneral']);?></span>
                        </th>
                        <th colspan="1" rowspan="3"></th>
                    </tr>
                    <tr>
                        <th colspan="2" class="der">
                        Cancelado
                        </th>
                        <th class="der">
                        <span class="badge badge-default"><?=num($ven['Cancelado']);?></span>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" class="der">
                        Cambio
                        </th>
                        <th class="der">
                        <span class="badge badge-default"><?=num($ven['Cambio']);?></span>
                        </th>
                    </tr>
                </tfoot>
            </table>
            </div>


    </div>
</div>
<?php require_once($folder."pie.php");?>