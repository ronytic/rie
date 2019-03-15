<?php
include_once("../../login/check.php");


$titulo="Listado de Marcas";
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

		var Nombre=$("[name=Nombre]").val();
		$.post("buscar.php",{'Nombre':Nombre},function(data){
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
        	<table class="table">
            	<tr>
                    <td>Nombre<input type="text" name="Nombre" class="form-control"></td>
                    <td><br><input type="submit" value="Buscar" class="btn btn-primary"></td>
                </tr>
            </table>


        </form>

	</div>
</div>
<div class="panel">
	<div class="panel-body table-responsive" id="respuesta">
	</div>
</div>
<?php include_once($folder."pie.php");?>
