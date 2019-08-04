<?php
include_once("../../login/check.php");

include_once("../../class/sucursal.php");
$sucursal=new sucursal;
$suc=$sucursal->mostrarTodoRegistro("",1,"Nombre");
$suc=todoLista($suc,"CodSucursal","Nombre");
$suc=array_unshift_assoc($suc,"%","Todos");

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
$marc=$marca->mostrarTodoRegistro("",1,"Nombre");
$mar=todoLista($marc,"CodMarca","Nombre");
$mar=array_unshift_assoc($mar,"%","Todos");

$est=array("0"=>"No Entregado","1"=>"Entregado");
$titulo="Listado de Pedidos";
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
		var Marca=$("[name=Marca]").val();
		var Nombre=$("[name=Nombre]").val();
		var NroPedido=$("[name=NroPedido]").val();
		var FechaPedido=$("[name=FechaPedido]").val();
		var FechaEntrega=$("[name=FechaEntrega]").val();
		var Estado=$("[name=Estado]").val();
		$.post("buscar.php",{Estado:Estado,'CodSucursal':CodSucursal,CodCategoria:CodCategoria,Marca:Marca,Nombre:Nombre,NroPedido:NroPedido,FechaPedido:FechaPedido,FechaEntrega:FechaEntrega},function(data){
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

        	<div class="table-responsive ">
				<table class="table">
					<tr>
						<td>
							<?php
                        if(!in_array( $_SESSION['NivelAcceso'],array(1,2))){
							$val="disabled";
                            echo campo("CodSucursal","hidden",$_SESSION['CodSucursal']);
                        }else{
							$val="";
                        }
						?>
						Sucursal
                        <?=campo("CodSucursal","select",$suc,"form-control",1,"",0,array($val=>$val),$_SESSION['CodSucursal'],0);?>
						</td>
						<td>Estado<?=campo("Estado","select",$est,"form-control",1,"",1,array(),0,0);?></td>
					</tr>

					<tr>
						<td>Categoria<?=campo("CodCategoria","select",$cat,"form-control",1,"",1,array(),0,0);?></td>
						<td>Marca<?=campo("Marca","text","","form-control",0,"",1,array(),0,0);?></td>
						<td>Nombre<input type="text" name="Nombre" class="form-control"></td>
					</tr>
					<tr>
						<td>Nro Pedido<input type="text" name="NroPedido" class="form-control"></td>
						<td>Fecha de Pedido<input type="date" name="FechaPedido" class="form-control"></td>
						<td>Fecha de Entrega<input type="date" name="FechaEntrega" class="form-control"></td>

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
