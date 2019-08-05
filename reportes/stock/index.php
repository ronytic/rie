<?php
include_once("../../login/check.php");


include_once("../../class/categoria.php");
$categoria=new categoria;
$cate=$categoria->mostrarTodoRegistro("",1,"Orden");
$cat=todoLista($cate,"CodCategoria","Nombre");
$cat=array_unshift_assoc($cat,"%","Todos");
// echo "<pre>";
// print_r($cat);
// echo "</pre>";
include_once("../../class/marca.php");
$marca=new marca;
$marc=$marca->mostrarTodoRegistro("",1,"Orden");
$mar=todoLista($marc,"CodMarca","Nombre");
$mar=array_unshift_assoc($mar,"%","Todos");


$titulo="Stock de Productos";
$folder="../../";



?>
<?php include_once($folder."cabecerahtml.php");?>
<style type="text/css">
.badge{
	cursor:pointer;
}
</style>
<script>
$(document).ready(function(){
	$(document).ajaxStart(function() {
		$("#respuesta").html('Cargando...');
	});
	$("#formulario").submit(function(e) {
        e.preventDefault();

		var CodCategoria=$("[name=CodCategoria]").val();
		var CodMarca=$("[name=CodMarca]").val();
		var Nombre=$("[name=Nombre]").val();

		$.post("buscar.php",{'Nombre':Nombre,CodCategoria:CodCategoria,CodMarca:CodMarca},function(data){
			$("#respuesta").html(data);
		});
    })
	//.submit();

	$('#Disponible').click(function(){
		if($(this).attr("rel")==1){
			$(this).attr("rel",0)
			$(this).removeClass('badge-primary');
			$('td  .badge-primary').parent().parent().fadeOut();
		}else{
			$(this).attr("rel",1)
			$(this).addClass('badge-primary');
			$('td  .badge-primary').parent().parent().fadeIn();
		}
	});

	$('#Comprar').click(function(){
		if($(this).attr("rel")==1){
			$(this).attr("rel",0)
			$(this).removeClass('badge-warning');
			$('td  .badge-warning').parent().parent().fadeOut();
		}else{
			$(this).attr("rel",1)
			$(this).addClass('badge-warning');
			$('td  .badge-warning').parent().parent().fadeIn();
		}
	});

	$('#Agotado').click(function(){
		if($(this).attr("rel")==1){
			$(this).attr("rel",0)
			$(this).removeClass('badge-danger');
			$('td  .badge-danger').parent().parent().fadeOut();
		}else{
			$(this).attr("rel",1)
			$(this).addClass('badge-danger');
			$('td  .badge-danger').parent().parent().fadeIn();
		}
	});

});

</script>
<?php include_once($folder."cabecera.php");?>
<div class="panel">
	<div class="panel-body">
		<form action="buscar.php" method="post" id="formulario">

        	<div class="table-responsive" style="border:transparent solid 0px !important;">
				<table class="table">
				            	<tr>
									<td width="50%">Categoria<?=campo("CodCategoria","select",$cat,"form-control",1,"",1,array(),0,0);?></td>
									<td width="50%">Marca<?=campo("CodMarca","select",$mar,"form-control",0,"",1,array(),0,0);?></td>


								</tr>
								<tr>
									<td>Nombre del Producto<input type="text" name="Nombre" class="form-control"></td>
									<td><br><input type="submit" value="Buscar " class="btn btn-primary"></td>
								</tr>
				            </table>
			</div>


        </form>
		<div class="pull-right">
<span class="badge badge-primary" id="Disponible" rel="1">Disponible</span>
<span class="badge badge-warning" id="Comprar" rel="1">Comprar</span>
<span class="badge badge-danger" id="Agotado" rel="1">Agotado</span>
</div>
	</div>
</div>
<div class="panel">
	<div class="panel-body table-responsive" id="respuesta">
	</div>
</div>
<?php include_once($folder."pie.php");?>
