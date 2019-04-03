<?php
include_once("../../login/check.php");


$CodCategoria=$_POST['CodCategoria'];
$CodMarca=$_POST['CodMarca'];
$Nombre=$_POST['Nombre'];

include_once("../../class/producto.php");
$producto=new producto;



include_once("../../class/categoria.php");
$categoria=new categoria;
include_once("../../class/marca.php");
$marca=new marca;
include_once("../../class/stock.php");
$stockactual=new stock;
include_once("../../class/sucursal.php");
$sucursal=new sucursal;
$suc=$sucursal->mostrarTodoRegistro("",1,"Nombre");
?>
<?php
	$cat=$categoria->mostrarTodoRegistro("CodCategoria LIKE '$CodCategoria'",1,"Nombre");
	foreach($cat as $c){
		?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="block" data-toggle="collapse" href="#collapse<?=$c['CodCategoria'];?>"><?=$c['Nombre'];?></a>
				</h4>
			</div>
			<div id="collapse<?=$c['CodCategoria'];?>" class="panel-collapse collapse in">
				<div class="">
					<?php
						if($_SESSION['NivelAcceso']==1 || $_SESSION['NivelAcceso']==2){
					?>
					<a href="#" class="btn btn-default btn-xs small pull-right exportarexcel" data-rel="c<?=$c['CodCategoria'];?>"><i class="fa fa-download"></i> Excel</a>
					<?php
						}
					?>
					<div class="table-responsive">
					<table class="sinborde table table-hover table-bordered table-striped table-condensed" id="c<?=$c['CodCategoria'];?>">
						<thead>
							<tr class="small">
								<th width="10">N</th>
								<th width="">Datos</th>
								<?php
									if($_SESSION['Clasificacion']!="%")
									{
										?>
										<th width="50">Precio</th>
										<?php
									}else{
										?>

										<th width="50">Unitario</th>
										<th width="50">Mayor</th>
										<th width="50">Especial</th>
										<?php
									}
								?>
								<?php
									foreach($suc as $s){
										?>
										<th width="50"><?=$s['Nombre'];?></th>
										<?php
									}
								?>
								<th width="50">Total</th>
								<th width="50">Estado</th>



							</tr>
						</thead>
						<tbody>
						<?php
							$pro=$producto->mostrarTodoRegistro("CodCategoria=".$c['CodCategoria']." and CodMarca LIKE '$CodMarca' and Nombre LIKE '%$Nombre%'",1,"Nombre",1);
							if(count($pro)==0){

								?>
								<tr>
									<td colspan="5">
									  No existen registros del producto buscado
									</td>
								</tr>
							<?php
							}
							$i=0;
							foreach($pro as $d){$i++;
								$c=$categoria->mostrarTodoRegistro("CodCategoria=".$d['CodCategoria']);
								$c=array_shift($c);
								$m=$marca->mostrarTodoRegistro("CodMarca=".$d['CodMarca']);
								$m=array_shift($m);
								// echo $d['CodProducto'];
								$totalstock=0;

								foreach($suc as $s){
									$st=$stockactual->obtener($d['CodProducto'],$s['CodSucursal']);
									$st=array_shift($st);
									$stock[$s['Nombre']]=(int)$st['Stock'];
									$totalstock+=(int)$st['Stock'];
								}
								// print_r($st);

								// $stock=0;
								//$totalstock=10;
								if($totalstock>0){
									$estado1="primary";
									$estado2="Disponible";
								}else{
									$estado1="danger";
									$estado2="Agotado";

								}
									?>
									<tr>
										<td class="small der"><?php echo $i;?></td>

										<td class="small resaltar" >
											<small class="badge badge-success">
											<?php
											$url="../imagenes/productos/".$d['Foto'];
											if(file_exists($url) && $d['Foto']!=""){
												?>
												<a href="<?=$url;?>" style="color:#FFF" target="_blank" title="Ver Foto">
												<?php echo ($d['Nombre'])?>
												<i class="fa fa-image"></i>

												</a>
												<?php
											}else{
												?>
												<?php echo ($d['Nombre'])?>
												<?php

											}
											?>
											</small>

											<small class="badge badge-default"><?php echo ($m['Nombre'])?></small>
										</td>
										<?php
											if($_SESSION['Clasificacion']!="%")
											{
												?>
												<td class=" der"><?php echo num($d['PrecioVenta'.ucwords($_SESSION['Clasificacion'])])?></td>
												<?php
											}else{
												?>
												<td class=" der"><?php echo num($d['PrecioVentaUnitario'])?></td>
												<td class=" der"><?php echo num($d['PrecioVentaMayor'])?></td>
												<td class=" der"><?php echo num($d['PrecioVentaEspecial'])?></td>
												<?php
											}
											?>
										<?php
											foreach($suc as $s){
												?>
												<td class="<?=$stock[$s['Nombre']]<=0?'danger':'success';?> resaltar der"><?=$stock[$s['Nombre']];?></td>
												<?php
											}
										?>
										<td class=" der"><?=$totalstock;?></td>
										<td class="small text-center"><span class="badge badge-<?=$estado1;?>"><?=$estado2;?></span></td>



									</tr>
								<?php
							}?>
						</tbody>
					</table>
					</div>
				</div>

			</div>
		</div>
		<?php
	}


