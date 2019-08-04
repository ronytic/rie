<?php
include_once("../../login/check.php");

include_once("../../class/sucursal.php");
$sucursal=new sucursal;
$sucu=$sucursal->mostrarTodoRegistro("",1,"Nombre");
$suc=todoLista($sucu,"CodSucursal","Nombre");
$suc=array_unshift_assoc($suc,"%","Todos");




include_once("../../class/cliente.php");
$cliente=new cliente;
$clie=$cliente->mostrarTodoRegistro("",1,"Nombres");
$cli=todoLista($clie,"CodCliente","Ci,Apellidos,Nombres");
$cli=array_unshift_assoc($cli,"%","Todos");
// echo "<pre>";
// print_r($cat);
// echo "</pre>";
include_once("../../class/marca.php");
$marca=new marca;
$marc=$marca->mostrarTodoRegistro("",1,"Orden");
$mar=todoLista($marc,"CodMarca","Nombre");
$mar=array_unshift_assoc($mar,"%","Todos");


$estado=array("Activo"=>"Activo","Anulado"=>"Anulado");

$titulo="Reporte de Ventas de Productos";
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
		var CodCliente=$("[name=CodCliente]").val();
		var Estado=$("[name=Estado]").val();

		var CodUsuario=$("[name=CodUsuario]").val();
		var Detalle=$("[name=Detalle]").val();
		var FechaDesde=$("[name=FechaDesde]").val();
		var FechaHasta=$("[name=FechaHasta]").val();
		$.post("buscar.php",{'CodSucursal':CodSucursal,CodCliente:CodCliente,Estado:Estado,FechaDesde:FechaDesde,FechaHasta:FechaHasta,Detalle:Detalle,CodUsuario:CodUsuario},function(data){
			$("#respuesta").html(data);
		});
    })
	// .submit();


	$(document).on("click",".eliminarDatos",function(e){
		e.preventDefault();
		var Estado=$(this).attr("data-estado");
		var TituloEstado=$(this).attr("data-tituloestado");
		swal("¿Esta Seguro de "+TituloEstado+" esta Venta?",{
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
					$.post("eliminar.php",{"Cod":Cod,Estado:Estado},function(data){
						$("#formulario").submit();
					});
				}break;
			}
		});
	});

});
</script>
<?php
$usus=$usuario->mostrarTodoRegistro("",1,"Apellidos,Nombres");
$us=todoLista($usus,"Cod","Apellidos,Nombres","");
$us=array_unshift_assoc($us,"%","Todos");
// echo "<pre>";
// print_r($us);
// echo "</pre>";

include_once($folder."cabecera.php");?>
<div class="panel">
	<div class="panel-body">
		<form action="buscar.php" method="post" id="formulario">

        	<div class="table-responsive sinborde">
				<table class="table">
				            	<tr>
									<td>Sucursal<?php
											if(!in_array( $_SESSION['NivelAcceso'],array(1,2))){
												$val="disabled";
												echo campo("CodSucursal","hidden",$_SESSION['CodSucursal']);
											}else{
												$val="";
											}
											?>
											<?=campo("CodSucursal","select",$suc,"form-control",1,"",0,array($val=>$val),$_SESSION['CodSucursal'],0);?>
									</td>
								</tr>
								<tr>
									<td>Cliente<?=campo("CodCliente","select",$cli,"form-control",0,"",1,array(),0,0);?></td>
									<td>Usuario<?=campo("CodUsuario","select",$us,"form-control",0,"",1,array(),0,0);?></td>
									<td>Estado<?=campo("Estado","select",$estado,"form-control",1,"",1,array(),0,0);?></td>
								</tr>
								<tr>
									<td>Detalle de Venta<?=campo("Detalle","text","","form-control",0,"",1,array(),0,0);?></td>
				                    <td>Fecha Desde<input type="date" name="FechaDesde" class="form-control" value="<?=fecha2Str("",0,"");?>" required></td>
				                    <td>Fecha Hasta<input type="date" name="FechaHasta" class="form-control" value="<?=fecha2Str("",0);?>" required></td>

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
