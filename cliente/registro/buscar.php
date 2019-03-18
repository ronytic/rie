<?php
include_once("../../login/check.php");


$Clasificacion=$_POST['Clasificacion'];
$Carnet=$_POST['Carnet'];
$Whatsapp=$_POST['Whatsapp'];
$Nombres=$_POST['Nombres'];
$Apellidos=$_POST['Apellidos'];

include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=$cliente->mostrarTodoRegistro("Clasificacion LIKE '$Clasificacion'  and Ci LIKE '$Carnet%' and Whatsapp LIKE '$Whatsapp%' and Nombres LIKE '%$Nombres%' and Apellidos LIKE '%$Apellidos%' ",1,"Nombres",1);
//print_r($di);


include_once("../../class/categoria.php");
$categoria=new categoria;
include_once("../../class/marca.php");
$marca=new marca;
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
	if(count($cli)==0){

		?>
		<tr>
			<td colspan="5">
			  No existen registros de los clientes buscados
			</td>
		</tr>
	<?php
	}
	$i=0;
	foreach($cli as $d){$i++;
		switch ($d['Clasificacion']) {
			case 'unitario':
				$ClasificacionCliente="Unitario";
				break;
			case 'mayor':
				$ClasificacionCliente="Mayor";
				break;
			case 'especial':
				$ClasificacionCliente="Especial";
				break;
		}

        ?>
        	<tr>
            	<td><?php echo $i;?></td>
            	<td class="small">
					<table class="table table-bordered">

						<tr>
							<td class="resaltar" colspan="2"><?php echo ($d['Nombres']." ".$d['Apellidos'])?></td>
						</tr>
						<tr>
							<td class=" resaltar" width="30%">Carnet: </td>
							<td class=""><?php echo ($d['Ci'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Whatsapp: </td>
							<td class=""><?php echo ($d['Whatsapp'])?></td>
						</tr>

					</table>


				</td>
				<td class="small">

					<table class="table table-bordered">
						<tr>
							<td class="der resaltar" width="30%">Clasificación: </td>
							<td><?php echo $ClasificacionCliente?></td>
						</tr>
						<tr>
							<td class="der resaltar">Dirección: </td>
							<td><?php echo $d['Direccion']?></td>
						</tr>
						<tr>
							<td class="der resaltar">Foto: </td>
							<td>
								<?php
									$url="../../imagenes/clientes/".$d['Foto'];
									if(file_exists($url)){

									?>
									<a href="<?=$url;?>" class="btn btn-info btn-xs" target="_blank"> <i class="fa fa-image"></i></a>
									<?php
								}
								?>
							</td>
						</tr>
					</table>
				</td>


                <td class="text-center">
                	<a href="modificar.php?Cod=<?php echo $d['CodCliente']?>"  class="btn btn-primary btn-xs " title="Modificar" rel="<?php echo $d['CodCliente']?>">
                    	<i class="fa fa-pencil"></i>
                    </a>
                </td>
                <td class="text-center">
                	<a href="eliminar.php?Cod=<?php echo $d['CodCliente']?>" class="btn btn-danger btn-xs eliminarDatos" title="Eliminar" rel="<?php echo $d['CodCliente']?>">
                    	<i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php
    }?>
</tbody>
</table>
