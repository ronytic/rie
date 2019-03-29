<?php
include_once("../../login/check.php");

include_once("../../class/sucursal.php");
$sucursal=new sucursal;
$sucu=$sucursal->mostrarTodoRegistro("",1,"Nombre");
$suc=todoLista($sucu,"CodSucursal","Nombre");
$suc=array_unshift_assoc($suc,"%","Todos");

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


$estado=array("Activo"=>"Activo","Anulado"=>"Anulado");

$titulo="Listado de Ingreso de Productos";
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
		var CodCategoria=$("[name=CodCategoria]").val();
		var CodMarca=$("[name=CodMarca]").val();
		var CodProducto=$("[name=CodProducto]").val();
		var Estado=$("[name=Estado]").val();
		var FechaDesde=$("[name=FechaDesde]").val();
		var FechaHasta=$("[name=FechaHasta]").val();
		$.post("buscar.php",{'CodSucursal':CodSucursal,CodCategoria:CodCategoria,CodMarca:CodMarca,CodProducto:CodProducto,Estado:Estado,FechaDesde:FechaDesde,FechaHasta:FechaHasta},function(data){
			$("#respuesta").html(data);
		});
    })
	// .submit();

	$("#CodCategoria,#CodMarca").change(function(){
            var CodCategoria=$("#CodCategoria").val();
            var CodMarca=$("#CodMarca").val();
            $.post("obtenerproducto.php",{CodCategoria:CodCategoria,CodMarca:CodMarca},function(data){
                $("#CodProducto").html(data);
            });
        });
	$(document).on("click",".eliminarDatos",function(e){
		e.preventDefault();
		swal("¿Esta Seguro de Anular este Ingreso?",{
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

        	<div class="table-responsive sinborde">
				<table class="table">
				            	<tr>
									<td>Sucursal<?=campo("CodSucursal","select",$suc,"form-control",1,"",1,array(),0,0);?></td>
								</tr>
								<tr>
									<td>Categoria<?=campo("CodCategoria","select",$cat,"form-control",1,"",1,array(),0,0);?></td>
									<td>Marca<?=campo("CodMarca","select",$mar,"form-control",0,"",1,array(),0,0);?></td>
									<td>Producto<?=campo("CodProducto","select",array(),"form-control",0,"",1,array(),0,1);?></td>
								</tr>
								<tr>
									<td>Estado<?=campo("Estado","select",$estado,"form-control",1,"",1,array(),0,0);?></td>
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
