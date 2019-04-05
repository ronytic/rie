<?php
include_once("../../login/check.php");


$titulo="Enviar Notificación";
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
	$(document).on("click","#enviar",function(e){
		e.preventDefault();
		swal("¿Esta Seguro de Enviar esta Notificación?",{
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
					var Titulo=$("[name=Titulo]").val();
					var Contenido=$("[name=Contenido]").val();
					var Url=$("[name=Url]").val();
					var TextoBoton1=$("[name=TextoBoton1]").val();
					var TextoBoton2=$("[name=TextoBoton2]").val();
					var Icono1=$("[name=Icono1]").val();
					var Icono2=$("[name=Icono2]").val();
					var Url1=$("[name=Url1]").val();
					var Url2=$("[name=Url2]").val();
					$.post("enviar.php",{"Titulo":Titulo,Contenido:Contenido,Url:Url,TextoBoton1:TextoBoton1,TextoBoton2:TextoBoton2,Icono1:Icono1,Icono2:Icono2,Url1:Url1,Url2:Url2},function(data){
						$("#respuesta").html(data);
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
		<fieldset>
			<legend>Código</legend>
				<pre>
					<?php
						echo htmlspecialchars($CodigoNotificación);
					?>
				</pre>
		</fieldset>
		<form action="buscar.php" method="post" id="formulario">
        	<table class="table">
            	<tr>
                    <td>Titulo <input type="text" name="Titulo" class="form-control" value="Nuevo Producto"></td>
                </tr>
				<tr>
                    <td colspan="2">Contenido del Mensaje <textarea name="Contenido" class="form-control" rows="5">Tenemos en Stock Nuevos Productos puede pasar por nuestras Tiendas para poder obtener mayor información</textarea>
					<span class="badge badge-info">El contenido no debe de ser mayor a 120 caracteres</span>
					</td>
                </tr>
				<tr>
                    <td>Titulo <input type="text" name="Url" class="form-control" value="http://www.bronison.com"></td>
                </tr>
				<tr>
                    <td>TextoBoton 1 <input type="text" name="TextoBoton1" class="form-control" value="Whatsapp"></td>
					<td>TextoBoton 2 <input type="text" name="TextoBoton2" class="form-control" placeholder="Ver Producto"></td>
                </tr>
				<tr>
                    <td>Icono 1 <input type="text" name="Icono1" class="form-control" value="https://addons-media.operacdn.com/media/extensions/25/191325/1.0.2-rev2/icons/icon_64x64_72ed78b63ef549be40b861f3ec0ee4d1.png"></td>
					<td>Icono 2 <input type="text" name="Icono2" class="form-control" placeholder="https://addons-media.operacdn.com/media/extensions/25/191325/1.0.2-rev2/icons/icon_64x64_72ed78b63ef549be40b861f3ec0ee4d1.png"></td>
                </tr>
				<tr>
                    <td>Url 1 <input type="text" name="Url1" class="form-control" value="https://wa.me/59173230568"></td>
					<td>Url 2 <input type="text" name="Url2" class="form-control" placeholder="https://wa.me/59173230568"></td>
                </tr>
				<td><br><input type="button" id="enviar" value="Enviar Notificación" class="btn btn-primary"></td>
            </table>


        </form>

	</div>
</div>
<div class="panel">
	<div class="panel-body table-responsive" id="respuesta">
	</div>
</div>
<?php include_once($folder."pie.php");?>
