<?php
include_once("../../login/check.php");

$CodSucursal=$_POST['CodSucursal'];
$CodCliente=$_POST['CodCliente'];
$Estado=$_POST['Estado'];

$Detalle=$_POST['Detalle'];
$FechaDesde=!empty($_POST['FechaDesde'])?$_POST['FechaDesde']:"%";
$FechaHasta=!empty($_POST['FechaHasta'])?$_POST['FechaHasta']:"%";

include_once("../../class/venta.php");
$venta=new venta;
$su=$venta->mostrarTodoRegistro("	Detalle LIKE '%$Detalle%' and
									CodSucursal LIKE '$CodSucursal' and
									CodCliente LIKE '$CodCliente' and

									Estado LIKE '$Estado' and
									FechaRegistro BETWEEN '$FechaDesde' and '$FechaHasta'
								",1,"FechaRegistro,HoraRegistro");
									// CodCategoria LIKE '$CodCategoria' and CodMarca LIKE '$CodMarca' and Nombre LIKE '%$Nombre%' and Calidad LIKE '%$Calidad%' and Codigo LIKE '%$Codigo%'",1,"Nombre",1);
//print_r($di);


include_once("../../class/cliente.php");
$cliente=new cliente;

include_once("../../class/sucursal.php");
$sucursal=new sucursal;
?>
<table class="table table-hover table-bordered table-striped table-table-condensed">
	<thead>
    	<tr>
        	<th width="10">N</th>
        	<th width="100">Datos</th>
			<th width="100">Detalle</th>


            <!-- <th width="40"></th> -->
            <th width="40"></th>
			<?php
				if(in_array( $_SESSION['NivelAcceso'],array(1,2))){
			?>
            <th width="40"></th>
			<?php
				}
			?>

        </tr>
    </thead>
	<tbody>
	<?php
	if(count($su)==0){

		?>
		<tr>
			<td colspan="5">
			  No existen registros de las venta buscados
			</td>
		</tr>
	<?php
	}
	$i=0;
	$totalgeneral=0;
	$totalcancelado=0;
	$totalcambio=0;
	foreach($su as $d){$i++;
		$c=$cliente->mostrarTodoRegistro("CodCliente=".$d['CodCliente']);
		$c=array_shift($c);


		$s=$sucursal->mostrarTodoRegistro("CodSucursal=".$d['CodSucursal']);
		$s=array_shift($s);

		$totalgeneral+=$d['TotalGeneral'];
		$totalcancelado+=$d['Cancelado'];
		$totalcambio+=$d['Cambio'];
        ?>
        	<tr>
            	<td class="der"><?php echo $i;?></td>
            	<td class="small">
					<table class="table table-bordered">


						<tr>
							<td class=" resaltar" width="35%">Cliente: </td>
							<td class=""><span class="badge badge-danger"><?php echo capitalizar($c['Nombres']." ".$c['Apellidos']." - ".$c['Ci'])?></span></td>
						</tr>
						<tr>
							<td class=" resaltar">Estado: </td>
							<td class=""><span class="badge badge-default"><?php echo ($d['Estado'])?></span></td>
						</tr>
						<tr>
							<td class=" resaltar">Sucursal: </td>
							<td class=""><span class="badge badge-default"><?php echo ($s['Nombre'])?></span></td>
						</tr>
						<tr>
							<td class=" resaltar">Detalle: </td>
							<td class=""><?php echo ($d['Detalle'])?></td>
						</tr>

					</table>


				</td>

				<td class="small">
					<table class="table table-bordered">
						<tr>
							<td class="der resaltar">Total: </td>
							<td class=""><span class="badge badge-danger"><?php echo num($d['TotalGeneral'])?></span></td>
						</tr>
						<tr>
							<td class="der resaltar">Cancelado: </td>
							<td class=""><span class="badge badge-default"><?php echo num($d['Cancelado'])?> </span></td>
						</tr>
						<tr>
							<td class="der resaltar">Cambio: </td>
							<td class=""><span class="badge badge-default"><?php echo num($d['Cambio'])?> </span></td>
						</tr>
						<tr>
							<td class="der resaltar">Fecha: </td>
							<td class=""><span class="badge badge-primary"><?php echo fecha2Str($d['FechaRegistro'])?> <?php echo ($d['HoraRegistro'])?></span></td>
						</tr>
					</table>
				</td>
				<?php
					/*
				?>
                <td class="text-center">
                	<a href="modificar.php?Cod=<?php echo $d['Codsalida']?>"  class="btn btn-primary btn-xs " title="Modificar" rel="<?php echo $d['Codsalida']?>">
                    	<i class="fa fa-pencil"></i>
                    </a>
				</td>
				<?php
					*/
				?>
				<td class="text-center">
					<a href="ver.php?Cod=<?php echo $d['CodVenta']?>" class="btn btn-success btn-xs " title="Ver" rel="<?php echo $d['CodVenta']?>">
                    	<i class="fa fa-search"></i>
                    </a>
				</td>
				<?php
					if(in_array( $_SESSION['NivelAcceso'],array(1,2))){
				?>
                <td class="text-center">

					<?php
						if($d['Estado']=="Activo"){
							$Estado='Anulado';
							$TituloEstado='Anular';
							$BtnEstado="danger";
						}else{
							$Estado='Activo';
							$TituloEstado='Activar';
							$BtnEstado="primary";

						}
					?>
                	<a href="eliminar.php?Cod=<?php echo $d['CodVenta']?>" class="btn btn-<?=$BtnEstado;?> btn-xs eliminarDatos" title="Eliminar" rel="<?php echo $d['CodVenta']?>" data-tituloestado="<?=$TituloEstado;?>" data-estado="<?=$Estado;?>">
                    	<i class="fa fa-close"></i> <?=$TituloEstado;?>
                    </a>
                </td>
				<?php
					}
				?>
            </tr>
        <?php
    }?>
</tbody>
<tfoot>
	<tr>
		<th colspan="1"></th>
		<th colspan="2" class="small">
			<table class="table table-bordered">
				<thead>
					<tr class="text-center">
						<th class="text-center">Total General</th>
						<th class="text-center">Total Cancelado</th>
						<th class="text-center">Total Cambio</th>
					</tr>
				</thead>
				<tr class="text-center">
					<td class=""><span class="badge badge-danger"><?php echo num($totalgeneral)?></span></td>
					<td class=""><span class="badge badge-default"><?php echo num($totalcancelado)?> </span></td>
					<td class=""><span class="badge badge-default"><?php echo num($totalcambio)?> </span></td>
				</tr>
			</table>
		</th>
		<th colspan="2"></th>
	</tr>
</tfoot>
</table>
