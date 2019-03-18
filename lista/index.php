<?php
include_once("../login/check.php");


include_once("../class/categoria.php");
$categoria=new categoria;
$cate=$categoria->mostrarTodoRegistro("",1,"Nombre");
$cat=todoLista($cate,"CodCategoria","Nombre");
$cat=array_unshift_assoc($cat,"%","Todos");
// echo "<pre>";
// print_r($cat);
// echo "</pre>";
include_once("../class/marca.php");
$marca=new marca;
$marc=$marca->mostrarTodoRegistro("",1,"Nombre");
$mar=todoLista($marc,"CodMarca","Nombre");
$mar=array_unshift_assoc($mar,"%","Todos");


$titulo="Listado Actualizada de Productos";
$folder="../";



?>
<?php include_once($folder."cabecerahtml.php");?>
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
    });
	$(document).on("click",".eliminarDatos",function(e){
		e.preventDefault();
		swal("¿Esta Seguro de Eliminar este Registro?",{
  			buttons: {
				cancel: true,
				confirm: {
					text:"Aceptar",
					value:'ok'
				}
  			}
		}).then((value)=>{
			switch (value) {
				case "ok":{
					var Cod=$(this).attr("rel");
					$.post("eliminar.php",{"Cod":Cod},function(data){
						$("#formulario").submit();
					});
				}break;
			}
		});
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

	</div>
</div>
<div class="panel">
	<div class="panel-body table-responsive" id="respuesta">
	</div>
</div>
<?php include_once($folder."pie.php");?>
