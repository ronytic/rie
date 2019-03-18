<?php
include_once("../../login/check.php");



$cla=array("%"=>"Todos","unitario"=>"Unitario","mayor"=>"Mayor","especial"=>"Especial");


$titulo="Listado de Clientes";
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

		var Clasificacion=$("[name=Clasificacion]").val();
		var Carnet=$("[name=Carnet]").val();
		var Whatsapp=$("[name=Whatsapp]").val();
		var Nombres=$("[name=Nombres]").val();
		var Apellidos=$("[name=Apellidos]").val();
		$.post("buscar.php",{'Clasificacion':Clasificacion,Carnet:Carnet,Whatsapp:Whatsapp,Nombres:Nombres,Apellidos:Apellidos},function(data){
			$("#respuesta").html(data);
		});
    });
	$(document).on("click",".eliminarDatos",function(e){
		e.preventDefault();
		swal("¿Esta Seguro de Eliminar este Cliente?",{
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
									<td>Clasificación<?=campo("Clasificacion","select",$cla,"form-control",1,"",1,array(),0,0);?></td>
				                    <td>Carnet<input type="text" name="Carnet" class="form-control"></td>
				                    <td>Whatsapp<input type="text" name="Whatsapp" class="form-control"></td>
				                    <td>Nombres<input type="text" name="Nombres" class="form-control"></td>
				                    <td>Apellidos<input type="text" name="Apellidos" class="form-control"></td>

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
