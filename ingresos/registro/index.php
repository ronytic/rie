<?php
require_once("../../login/check.php");
// print_r($_SESSION);

include_once("../../class/sucursal.php");
$sucursal=new sucursal;
$sucu=$sucursal->mostrarTodoRegistro("",1,"Nombre");
$suc=todoLista($sucu,"CodSucursal","Nombre");

include_once("../../class/categoria.php");
$categoria=new categoria;
$cate=$categoria->mostrarTodoRegistro("",1,"Orden");
$cat=todoLista($cate,"CodCategoria","Nombre");
include_once("../../class/marca.php");
$marca=new marca;
$marc=$marca->mostrarTodoRegistro("",1,"Orden");
$mar=todoLista($marc,"CodMarca","Nombre");
if(!isset($_SESSION['AccessSystem'])){die('System Error');}
$titulo="Registro de Ingreso de Producto";
$folder="../../";
?>
<?php require_once($folder."cabecerahtml.php");?>

<script>
    let l=0;
    $(document).ready(function(){
        // alert("s");
        $("#CodProducto").select2();
        $("#CodCategoria,#CodMarca").change(function(){
            var CodCategoria=$("#CodCategoria").val();
            var CodMarca=$("#CodMarca").val();
            $.post("obtenerproducto.php",{CodCategoria:CodCategoria,CodMarca:CodMarca},function(data){
                $("#CodProducto").html(data);
                $("#CodProducto").select2();
            });
        });

        $(document).on("focus","#Precio,#Cantidad",function(){
            $(this).select();
        });
        $("#aumentar").click(function (e) {
            e.preventDefault();
            //alert($("#CodProducto >option:selected").html());
            var CodProducto=$("#CodProducto").val();
            var Cantidad=$("#Cantidad").val();
            $("#Cantidad").val(0)
            var Detalle=$("#Detalle").val();
            $("#Detalle").val('');
            if(CodProducto!=""){
                l++;
                $.post("guardarproducto.php",{"l":l,"CodProducto":CodProducto,Cantidad:Cantidad,Detalle:Detalle},function(data){
                    $("#marca").append(data);
                });
            }
        });
        $(document).on("click",".eliminarfila",function(e){
            e.preventDefault();
            swal("¿Esta Seguro de Eliminar este Ingreso?",{
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
                        $(this).parent().parent().remove();
                    }break;
                }
            });
        });
    });
    function listarproducto() {
        $.post("listadoproductos.php",{"CodProducto":CodProducto,Cantidad:Cantidad,Detalle:Detalle},function(data){

        });
    }
</script>
<?php require_once($folder."cabecera.php");?>
<div class="panel">
    <div class="panel-heading"><h3></h3></div>
    <div class="panel-body">
        <form action="guardar.php" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td class="text-right middle" width="30%">Sucursal</td>
                    <td><?=campo("CodSucursal","select",$suc,"form-control",1,"",1,array(),0,1);?></td>
                </tr>
            </table>
            <table class="table table-bordered table-hover ">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th width="100">Cantidad</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody >
                <tr>
                    <td>
                        <?=campo("CodCategoria","select",$cat,"form-control input-sm",1,"",1,array(),0,1);?>
                        <?=campo("CodMarca","select",$mar,"form-control",1,"",1,array(),0,1);?>
                        <?=campo("CodProducto","select",array(),"form-control",1,"",1,array(),0,1);?>
                    </td>
                    <td><input type="number" name="Cantidad" id="Cantidad" class="form-control der" min="0" step="1" value="0"></td>
                    <td><input type="text" name="Detalle" id="Detalle" class="form-control"  >
                    <br>
                    <a href="#" class="btn btn-success block" id="aumentar"> <i class="fa fa-plus "></i> Agregar</a>
                        </td>
                </tr>

                </tbody>
            </table>
            <br>
            <div id="listado">
            <table class="table table-bordered table-hover ">
                <thead>
                    <tr>
                        <th width="10" style="width:10px !important;">N</th>
                        <th>Producto</th>
                        <th width="100">Cantidad</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody id="marca">
                </tbody>
            </table>
            </div>
            <br>
            <input type="submit" value="Guardar" class="btn btn-primary">
        </form>
    </div>
</div>
<?php require_once($folder."pie.php");?>
