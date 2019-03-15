<?php
include_once("../../login/check.php");


$Nombre=$_POST['Nombre'];

include_once("../../class/marca.php");
$marca=new marca;
$cat=$marca->mostrarTodoRegistro("Nombre LIKE '$Nombre%'",1,"Nombre");
//print_r($di);


?>
<table class="table table-hover table-bordered table-striped table-table-condensed">
	<thead>
    	<tr>
        	<th width="10">N</th>
        	<th width="">Nombre</th>
            <th width="50"></th>
            <th width="50"></th>

        </tr>
    </thead>
	<tbody>
	<?php
	if(count($cat)==0){

		?>
		<tr>
			<td colspan="5">
			  No existen registros de marcas
			</td>
		</tr>
	<?php
	}
	$i=0;
	foreach($cat as $d){$i++;
        ?>
        	<tr>
            	<td><?php echo $i;?></td>
            	<td><?php echo ($d['Nombre'])?></td>

                <td>
                	<a href="modificar.php?Cod=<?php echo $d['CodMarca']?>"  class="btn btn-primary btn-xs " title="Modificar" rel="<?php echo $d['CodMarca']?>">
                    	<i class="fa fa-pencil"></i>
                    </a>
                </td>
                <td>
                	<a href="eliminar.php?Cod=<?php echo $d['CodMarca']?>" class="btn btn-danger btn-xs eliminarDatos" title="Eliminar" rel="<?php echo $d['CodMarca']?>">
                    	<i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php
    }?>
</tbody>
</table>
