<?php
include_once("../../login/check.php");


include_once("../../class/categoria.php");
$categoria=new categoria;
$cate=$categoria->mostrarTodoRegistro("",1,"Nombre");
$cat=todoLista($cate,"CodCategoria","Nombre");
$cat=array_unshift_assoc($cat,"%","Todos");
// echo "<pre>";
// print_r($cat);
// echo "</pre>";
include_once("../../class/marca.php");
$marca=new marca;
$marc=$marca->mostrarTodoRegistro("",1,"Nombre");
$mar=todoLista($marc,"CodMarca","Nombre");
$mar=array_unshift_assoc($mar,"%","Todos");


$titulo="Listado de Productos";
$folder="../../";



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
		var Calidad=$("[name=Calidad]").val();
		var Codigo=$("[name=Codigo]").val();
		$.post("buscar.php",{'Nombre':Nombre,CodCategoria:CodCategoria,CodMarca:CodMarca,Calidad:Calidad,Codigo:Codigo},function(data){
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

        	<div class="table-responsive">
				<table class="table">
				            	<tr>
									<td>Categoria<?=campo("CodCategoria","select",$cat,"form-control",1,"",1,array(),0,0);?></td>
									<td>Marca<?=campo("CodMarca","select",$mar,"form-control",0,"",1,array(),0,0);?></td>
				                    <td>Nombre<input type="text" name="Nombre" class="form-control"></td>
				                    <td>Calidad<input type="text" name="Calidad" class="form-control"></td>
				                    <td>Código<input type="text" name="Codigo" class="form-control"></td>

								</tr>
								<tr>
								<td><input type="submit" value="Buscar" class="btn btn-primary"></td>
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
