<?php
include_once("../../login/check.php");


$CodSucursal=$_POST['CodSucursal'];
$NivelAcceso=$_POST['NivelAcceso'];
$Nombres=$_POST['Nombres'];
$Apellidos=$_POST['Apellidos'];
$Ci=$_POST['Ci'];

include_once("../../class/usuario.php");
$usuario=new usuario;
$su=$usuario->mostrarTodoRegistro("NivelAcceso!=1 and CodSucursal LIKE '$CodSucursal' and NivelAcceso LIKE '$NivelAcceso' and Nombres LIKE '%$Nombres%' and Apellidos LIKE '%$Apellidos%' and Ci LIKE '%$Ci%'",1,"Apellidos,Nombres",1);
//print_r($di);


include_once("../../class/sucursal.php");
$sucursal=new sucursal;
include_once("../../class/acceso.php");
$acceso=new acceso;
?>
<table class="table table-hover table-bordered table-striped table-table-condensed">
	<thead>
    	<tr>
        	<th width="10">N</th>
        	<th width="100">Datos</th>


        	<th width="100">Detalles</th>
			<?php
					if(in_array( $_SESSION['NivelAcceso'],array(1,2))){
				?>
            <th width="40"></th>
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
			  No existen registros de los usuarios buscados
			</td>
		</tr>
	<?php
	}
	$i=0;
	foreach($su as $d){$i++;
		$s=$sucursal->mostrarTodoRegistro("CodSucursal=".$d['CodSucursal']);
		$s=array_shift($s);
		$a=$acceso->mostrarTodoRegistro("CodAcceso=".$d['NivelAcceso']);
		$a=array_shift($a);
        ?>
        	<tr>
            	<td><?php echo $i;?></td>
            	<td class="small">
					<table class="table table-bordered">
						<tr>
							<td class=" resaltar" width="30%">Apellidos: </td>
							<td class=""><?php echo ($d['Apellidos'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Nombres: </td>
							<td class=""><?php echo ($d['Nombres'])?></td>
						</tr>
						<tr>
							<td class=" resaltar">Carnet: </td>
							<td class=""><?php echo ($d['Ci'])?></td>
						</tr>


					</table>


				</td>

				<td class="small">
					<table class="table table-bordered">

						<tr>
							<td class="der resaltar" width="30%">Sucursal: </td>
							<td class=""><span class="badge badge-danger"><?php echo (isset($s['Nombre'])?$s['Nombre']:"Todos")?></span></td>
						</tr>
						<tr>
							<td class="der resaltar">Nivel Acceso: </td>
							<td class=""><span class="badge badge-primary"><?php echo ($a['Nombre'])?></span></td>
						</tr>
						<tr>
							<td class="der resaltar">Usuario: </td>
							<td class=""><?php echo ($d['Usuario'])?></td>
						</tr>

					</table>
				</td>

				<?php
					if(in_array( $_SESSION['NivelAcceso'],array(1,2))){
				?>
                <td class="text-center">
                	<a href="modificar.php?Cod=<?php echo $d['Cod']?>"  class="btn btn-primary btn-xs " title="Modificar" rel="<?php echo $d['Cod']?>">
                    	<i class="fa fa-pencil"></i>
                    </a>
                </td>
                <td class="text-center">
                	<a href="eliminar.php?Cod=<?php echo $d['Cod']?>" class="btn btn-danger btn-xs eliminarDatos" title="Eliminar" rel="<?php echo $d['Cod']?>">
                    	<i class="fa fa-trash"></i>
                    </a>
                </td>
				<?php
					}
				?>
            </tr>
        <?php
    }?>
</tbody>
</table>
