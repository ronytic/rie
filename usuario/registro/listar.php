<?php
include_once("../../login/check.php");


include_once("../../class/acceso.php");
$acceso=new acceso;
$acc=$acceso->mostrarTodoRegistro("Visible=1",1,"Nombre");
$acc=todoLista($acc,"CodAcceso","Nombre");
$acc=array_unshift_assoc($acc,"%","Todos");
// echo "<pre>";
// print_r($cat);
// echo "</pre>";
include_once("../../class/sucursal.php");
$sucursal=new sucursal;
$suc=$sucursal->mostrarTodoRegistro("",1,"Nombre");
$suc=todoLista($suc,"CodSucursal","Nombre");
$suc=array_unshift_assoc($suc,"%","Todos");


$titulo="Listado de Usuarios";
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

		var CodSucursal=$("[name=CodSucursal]").val();
		var NivelAcceso=$("[name=NivelAcceso]").val();
		var Nombres=$("[name=Nombres]").val();
		var Apellidos=$("[name=Apellidos]").val();
		var Ci=$("[name=Ci]").val();
		$.post("buscar.php",{'CodSucursal':CodSucursal,NivelAcceso:NivelAcceso,Nombres:Nombres,Apellidos:Apellidos,Ci:Ci},function(data){
			$("#respuesta").html(data);
		});
	})
	.submit();
	$(document).on("click",".eliminarDatos",function(e){
		e.preventDefault();
		swal("¿Esta Seguro de Eliminar este Usuario?",{
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
									<td>Sucursal<?=campo("CodSucursal","select",$suc,"form-control",1,"",1,array(),0,0);?></td>
									<td>Nivel de Acceso<?=campo("NivelAcceso","select",$acc,"form-control",0,"",1,array(),0,0);?></td>
				                    <td>Nombres<input type="text" name="Nombres" class="form-control"></td>
				                    <td>Apellidos<input type="text" name="Apellidos" class="form-control"></td>
				                    <td>Carnet<input type="text" name="Ci" class="form-control"></td>

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
