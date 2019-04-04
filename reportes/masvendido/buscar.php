<?php
include_once("../../login/check.php");

$CodSucursal=$_POST['CodSucursal'];
$CodUsuario=$_POST['CodUsuario'];

$Detalle=$_POST['Detalle'];
$FechaDesde=!empty($_POST['FechaDesde'])?$_POST['FechaDesde']:"%";
$FechaHasta=!empty($_POST['FechaHasta'])?$_POST['FechaHasta']:"%";

include_once("../../class/salida.php");
$salida=new salida;
$su=$salida->mostrarTodoRegistro("
									CodSucursal LIKE '$CodSucursal' and

									CodUsuario LIKE '$CodUsuario' and
									CodVenta!=0 and
									FechaRegistro BETWEEN '$FechaDesde' and '$FechaHasta'

									GROUP BY CodProducto
								",1,"FechaRegistro,HoraRegistro");
									// CodCategoria LIKE '$CodCategoria' and CodMarca LIKE '$CodMarca' and Nombre LIKE '%$Nombre%' and Calidad LIKE '%$Calidad%' and Codigo LIKE '%$Codigo%'",1,"Nombre",1);
//print_r($di);
$su=$salida->masvendido($CodSucursal,$Detalle,$CodUsuario,$FechaDesde,$FechaHasta);
// echo "<pre>";
// print_r($su);
// echo "</pre>";
// exit();

include_once("../../class/producto.php");
$producto=new producto;

include_once("../../class/categoria.php");
$categoria=new categoria;
include_once("../../class/marca.php");
$marca=new marca;

include_once("../../class/sucursal.php");
$sucursal=new sucursal;

include_once("../../class/usuario.php");
$usuario=new usuario;
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
				/*if(in_array( $_SESSION['NivelAcceso'],array(1,2))){
			?>
            <th width="40"></th>
			<?php
				}*/
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
	$CantidadVendido=0;
	$TotalVendido=0;
	foreach($su as $d){$i++;

		$p=$producto->mostrarTodoRegistro("CodProducto=".$d['CodProducto']);
		$p=array_shift($p);


		$m=$marca->mostrarTodoRegistro("CodMarca=".$p['CodMarca']);
		$m=array_shift($m);

		$c=$categoria->mostrarTodoRegistro("CodCategoria=".$p['CodCategoria']);
		$c=array_shift($c);

		$CantidadVendido+=$d['Cantidad'];
		$TotalVendido+=$d['Total'];
        ?>
        	<tr>
            	<td class="der"><?php echo $i;?></td>
				<td class="small">


				<table class="table table-bordered">

					<tr>
						<td class="resaltar" colspan="2"><?php echo ($p['Nombre'])?></td>
					</tr>
					<tr>
						<td class=" resaltar" width="35%">Categoria: </td>
						<td class=""><?php echo ($c['Nombre'])?></td>
					</tr>
					<tr>
						<td class=" resaltar">Marca: </td>
						<td class=""><?php echo ($m['Nombre'])?></td>
					</tr>
					<tr>
						<td class=" resaltar">Cantidad Vendida: </td>
						<td class=""><span class="badge badge-danger"><?php echo ($d['Cantidad'])?></span></td>
					</tr>
					<tr>
						<td class=" resaltar">Total </td>
						<td class=""><span class="badge badge-primary"><?php echo num($d['Total'])?></span></td>
					</tr>


				</table>
				</td>
				<td class="small">
					<table class="table table-bordered">

						<tr>
							<td class="der resaltar" width="60%">Unitario: </td>
							<td class="der"><?php echo num($p['PrecioVentaUnitario'])?></td>
						</tr>
						<tr>
							<td class="der resaltar">Mayor: </td>
							<td class="der"><?php echo num($p['PrecioVentaMayor'])?></td>
						</tr>
						<tr>
							<td class="der resaltar">Especial: </td>
							<td class="der"><?php echo num($p['PrecioVentaEspecial'])?></td>
						</tr>
						<tr>
							<td class="der resaltar">Cant. Mínima: </td>
							<td class="der"><?php echo ($p['CantidadMinima'])?></td>
						</tr>
					</table>
				</td>
				<td class="small">

					<table class="table table-bordered">
						<tr>
							<td class="der resaltar" width="40%">Color: </td>
							<td><div style="width:20px;height:20px;background-color:<?php echo $p['Color']?>" ></div></td>
						</tr>
						<tr>
							<td class="der resaltar">Caracteristicas: </td>
							<td><?php echo $p['Caracteristicas']?></td>
						</tr>
						<tr>
							<td class="der resaltar">Calidad: </td>
							<td><?php echo $p['Calidad']?></td>
						</tr>
						<tr>
							<td class="der resaltar">Código: </td>
							<td><?php echo $p['Codigo']?></td>
						</tr>
						<tr>
							<td class="der resaltar">Foto: </td>
							<td>
								<?php
								$url="../../imagenes/productos/".$p['Foto'];
								if(file_exists($url) && $p['Foto']!=""){
									?>
									<a href="<?=$url;?>" class="btn btn-info btn-xs" target="_blank"> <i class="fa fa-image"></i></a>
									<?php
								}
								?>
							</td>
						</tr>
					</table>
				</td>
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
						<th class="text-center">Cantidad Vendida</th>
						<th class="text-center">Total Vendido</th>

					</tr>
				</thead>
				<tr class="text-center">
					<td class=""><span class="badge badge-danger"><?php echo ($CantidadVendido)?></span></td>
					<td class=""><span class="badge badge-primary"><?php echo num($TotalVendido)?></span></td>
				</tr>
			</table>
		</th>
		<th colspan="2"></th>
	</tr>
</tfoot>
</table>
