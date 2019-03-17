<?php
include_once("../../login/check.php");


$CodCategoria=$_POST['CodCategoria'];
$CodMarca=$_POST['CodMarca'];
$Nombre=$_POST['Nombre'];
$Calidad=$_POST['Calidad'];
$Codigo=$_POST['Codigo'];

include_once("../../class/producto.php");
$producto=new producto;
$su=$producto->mostrarTodoRegistro("CodCategoria LIKE '$CodCategoria' and CodMarca LIKE '$CodMarca' and Nombre LIKE '%$Nombre%' and Calidad LIKE '%$Calidad%' and Codigo LIKE '%$Codigo%'",1,"Nombre",1);
//print_r($di);


?>
<table class="table table-hover table-bordered table-striped table-table-condensed">
	<thead>
    	<tr>
        	<th width="10">N</th>
        	<th width="100">Nombre</th>

			<th width="100">Precios de Venta</th>
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
			  No Existen Registros de productos
			</td>
		</tr>
	<?php
	}
	$i=0;
	foreach($su as $d){$i++;
        ?>
        	<tr>
            	<td><?php echo $i;?></td>
            	<td><?php echo ($d['Nombre'])?></td>

				<td class="small">
				<table class="table table-bordered">

						<tr>
							<td class="der resaltar">Unitario: </td>
							<td class="der"><?php echo num($d['PrecioVentaUnitario'])?></td>
						</tr>
						<tr>
							<td class="der resaltar">Mayor: </td>
							<td class="der"><?php echo num($d['PrecioVentaMayor'])?></td>
						</tr>
						<tr>
							<td class="der resaltar">Especial: </td>
							<td class="der"><?php echo num($d['PrecioVentaEspecial'])?></td>
						</tr>
					</table>
				</td>
				<td class="small">

					<table class="table table-bordered">
						<tr>
							<td class="der resaltar">Color: </td>
							<td><div style="width:20px;height:20px;background-color:<?php echo $d['Color']?>" ></div></td>
						</tr>
						<tr>
							<td class="der resaltar">Caracteristicas: </td>
							<td><?php echo $d['Caracteristicas']?></td>
						</tr>
						<tr>
							<td class="der resaltar">Calidad: </td>
							<td><?php echo $d['Calidad']?></td>
						</tr>
						<tr>
							<td class="der resaltar">Código: </td>
							<td><?php echo $d['Codigo']?></td>
						</tr>
						<tr>
							<td class="der resaltar">Foto: </td>
							<td><a href="../../imagenes/productos/<?php echo $d['Foto']?>" class="btn btn-info btn-xs" target="_blank"> <i class="fa fa-image"></i></a></td>
						</tr>
					</table>
				</td>


                <td class="text-center">
                	<a href="modificar.php?Cod=<?php echo $d['CodProducto']?>"  class="btn btn-primary btn-xs " title="Modificar" rel="<?php echo $d['CodProducto']?>">
                    	<i class="fa fa-pencil"></i>
                    </a>
                </td>
                <td class="text-center">
                	<a href="eliminar.php?Cod=<?php echo $d['CodProducto']?>" class="btn btn-danger btn-xs eliminarDatos" title="Eliminar" rel="<?php echo $d['CodProducto']?>">
                    	<i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php
    }?>
</tbody>
</table>
