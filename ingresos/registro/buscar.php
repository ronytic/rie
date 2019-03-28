<?php
include_once("../../login/check.php");


$CodSucursal=$_POST['CodSucursal'];
$CodCategoria=$_POST['CodCategoria'];
$CodMarca=$_POST['CodMarca'];
$CodProducto=!empty($_POST['CodProducto'])?$_POST['CodProducto']:"%";
$Estado=$_POST['Estado'];
$FechaDesde=!empty($_POST['FechaDesde'])?$_POST['FechaDesde']:"%";
$FechaHasta=!empty($_POST['FechaHasta'])?$_POST['FechaHasta']:"%";

include_once("../../class/ingreso.php");
$ingreso=new ingreso;
$su=$ingreso->mostrarTodoRegistro("CodSucursal LIKE '$CodSucursal' and
									Estado LIKE '$Estado' and
									FechaRegistro BETWEEN '$FechaDesde' and '$FechaHasta' and
									CodProducto IN (SELECT CodProducto FROM producto WHERE CodProducto LIKE '$CodProducto' and CodCategoria LIKE '$CodCategoria' and CodMarca LIKE '$CodMarca' and Activo=1)
								",1,"FechaRegistro,HoraRegistro");
									// CodCategoria LIKE '$CodCategoria' and CodMarca LIKE '$CodMarca' and Nombre LIKE '%$Nombre%' and Calidad LIKE '%$Calidad%' and Codigo LIKE '%$Codigo%'",1,"Nombre",1);
//print_r($di);


include_once("../../class/categoria.php");
$categoria=new categoria;
include_once("../../class/marca.php");
$marca=new marca;
include_once("../../class/producto.php");
$producto=new producto;
?>
<table class="table table-hover table-bordered table-striped table-table-condensed">
	<thead>
    	<tr>
        	<th width="10">N</th>
        	<th width="100">Datos</th>

			<th width="100">Detalle</th>


            <!-- <th width="40"></th> -->
            <th width="40"></th>

        </tr>
    </thead>
	<tbody>
	<?php
	if(count($su)==0){

		?>
		<tr>
			<td colspan="5">
			  No existen registros de los productos buscados
			</td>
		</tr>
	<?php
	}
	$i=0;
	foreach($su as $d){$i++;
		$p=$producto->mostrarTodoRegistro("CodProducto=".$d['CodProducto']);
		$p=array_shift($p);
		$c=$categoria->mostrarTodoRegistro("CodCategoria=".$p['CodCategoria']);
		$c=array_shift($c);
		$m=$marca->mostrarTodoRegistro("CodMarca=".$p['CodMarca']);
		$m=array_shift($m);
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

					</table>


				</td>

				<td class="small">
					<table class="table table-bordered">

						<tr>
							<td class="der resaltar" width="30%">Cantidad: </td>
							<td class=""><?php echo ($d['Cantidad'])?></td>
						</tr>
						<tr>
							<td class="der resaltar">Estado: </td>
							<td class=""><span class="badge badge-warning"><?php echo ($d['Estado'])?></span></td>
						</tr>
						<tr>
							<td class="der resaltar">Detalle: </td>
							<td class=""><?php echo ($d['Detalle'])?></td>
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
                	<a href="modificar.php?Cod=<?php echo $d['CodIngreso']?>"  class="btn btn-primary btn-xs " title="Modificar" rel="<?php echo $d['CodIngreso']?>">
                    	<i class="fa fa-pencil"></i>
                    </a>
				</td>
				<?php
					*/
				?>
                <td class="text-center">
                	<a href="eliminar.php?Cod=<?php echo $d['CodIngreso']?>" class="btn btn-danger btn-xs eliminarDatos" title="Eliminar" rel="<?php echo $d['CodIngreso']?>">
                    	<i class="fa fa-close"></i> Anular
                    </a>
                </td>
            </tr>
        <?php
    }?>
</tbody>
</table>
