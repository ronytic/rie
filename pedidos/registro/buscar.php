<?php
include_once("../../login/check.php");

// print_r($_POST);

$CodSucursal=$_POST['CodSucursal'];
$CodCategoria=$_POST['CodCategoria'];
$Marca=$_POST['Marca'];
$Nombre=$_POST['Nombre'];
$NroPedido=$_POST['NroPedido'];
$FechaPedido=$_POST['FechaPedido'];
$FechaEntrega=$_POST['FechaEntrega'];
$Estado=$_POST['Estado'];
$FechaPedido=$FechaPedido!=""?$FechaPedido:"%";
$FechaEntrega=$FechaEntrega!=""?$FechaEntrega:"%";
$NroPedido=$NroPedido !=""?$NroPedido :"%";

include_once("../../class/pedido.php");
$pedido=new pedido;
$su=$pedido->mostrarTodoRegistro("Estado='$Estado' and CodSucursal LIKE '$CodSucursal' and CodCategoria LIKE '$CodCategoria' and Marca LIKE '$Marca%' and Nombre LIKE '%$Nombre%' and NroPedido LIKE '$NroPedido' and FechaPedido LIKE '$FechaPedido' and FechaEntrega LIKE '$FechaEntrega'",1,"FechaEntrega,Nombre",1);
//print_r($di);


include_once("../../class/categoria.php");
$categoria=new categoria;
include_once("../../class/sucursal.php");
$sucursal=new sucursal;
?>
<table class="table table-hover table-bordered table-striped table-table-condensed">
	<thead>
    	<tr>
        	<th width="10">N</th>
        	<th width="100">Datos</th>
        	<th width="100">Detalles</th>

            <th width="40"></th>
            <th width="40"></th>

        </tr>
    </thead>
	<tbody>
	<?php
	if(count($su)==0){

		?>
		<tr>
			<td colspan="5">
			  No existen registros de los pedidos buscados
			</td>
		</tr>
	<?php
	}
	$i=0;
	foreach($su as $d){$i++;
		$c=$categoria->mostrarTodoRegistro("CodCategoria=".$d['CodCategoria']);
		$c=array_shift($c);
		$s=$sucursal->mostrarTodoRegistro("CodSucursal=".$d['CodSucursal']);
		$s=array_shift($s);
        ?>
        	<tr>
            	<td><?php echo $i;?></td>
            	<td class="small">
					<table class="table table-bordered">

						<tr>
							<td class="resaltar" colspan="2"><?php echo ($d['Nombre'])?></td>
						</tr>
						<tr>
							<td class=" resaltar" width="30%">Categoria: </td>
							<td class=""><?php echo ($c['Nombre'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Marca: </td>
							<td class=""><?php echo ($d['Marca'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Sucursal: </td>
							<td class=""><span class="badge badge-danger"><?php echo ($s['Nombre'])?></span></td>
						</tr>
					</table>


				</td>

				<td class="small">
					<table class="table table-bordered">

						<tr>
							<td class="der resaltar" width="50%">Detalle: </td>
							<td class=""><?php echo ($d['Detalle'])?></td>
						</tr>
						<tr>
							<td class="der resaltar">Nro Pedido: </td>
							<td class=""><?php echo ($d['NroPedido'])?></td>
						</tr>
						<tr>
							<td class="der resaltar">Fecha de Pedido: </td>
							<td class=""><span class="badge badge-primary"><?php echo fecha2str($d['FechaPedido'])?></span></td>
						</tr>
						<tr>
							<td class="der resaltar">Fecha de Entrega: </td>
							<td class=""><span class="badge badge-success"><?php echo fecha2str($d['FechaEntrega'])?></span></td>
						</tr>
					</table>
				</td>
                <td class="text-center">
                	<a href="modificar.php?Cod=<?php echo $d['CodPedido']?>"  class="btn btn-primary btn-xs " title="Modificar" rel="<?php echo $d['CodPedido']?>">
                    	<i class="fa fa-pencil"></i>
                    </a>
                </td>
                <td class="text-center">
                	<a href="eliminar.php?Cod=<?php echo $d['CodPedido']?>" class="btn btn-danger btn-xs eliminarDatos" title="Eliminar" rel="<?php echo $d['CodPedido']?>">
                    	<i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php
    }?>
</tbody>
</table>
