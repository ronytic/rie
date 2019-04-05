<?php
require_once("../../login/check.php");
// require_once("../../class/stock.php");
// $stock=new stock;
// $sal=$stock->obtener(4,3);
// $sal=array_shift($sal);
// print_r($sal);
include_once("../../class/sucursal.php");
$sucursal=new sucursal;
$sucu=$sucursal->mostrarTodoRegistro("",1,"Nombre");
$suc=todoLista($sucu,"CodSucursal","Nombre");

include_once("../../class/categoria.php");
$categoria=new categoria;
$cate=$categoria->mostrarTodoRegistro("",1,"Nombre");
$cat=todoLista($cate,"CodCategoria","Nombre");
include_once("../../class/marca.php");
$marca=new marca;
$marc=$marca->mostrarTodoRegistro("",1,"Nombre");
$mar=todoLista($marc,"CodMarca","Nombre");

$titulo="Registro de Traspaso de Productos";
$folder="../../";
?>
<?php require_once($folder."cabecerahtml.php");?>

<script>
    let l=0;
    $(document).ready(function(){
        $("#CodProducto").select2();
        $(document).on("focus","#Precio,#Cantidad",function(){
            $(this).select();
        });
        // alert("s");
        $("#CodCategoria,#CodMarca").change(function(e){
            var CodCategoria=$("#CodCategoria").val();
            var CodMarca=$("#CodMarca").val();
            if($("#CodSucursalOrigen").val()==""){
                swal("Seleccionar una sucursal de origen ",{
                buttons: {

                    confirm: {
                        text:"Aceptar",
                        value:'ok'
                    }
                }
            });
                e.preventDefault();
            }else{
                $.post("obtenerproducto.php",{CodCategoria:CodCategoria,CodMarca:CodMarca},function(data){
                    $("#CodProducto").html(data);
                    $("#CodProducto").select2();
                });
            }
        });
        $(document).on("change","#CodProducto",function(){
            var CodProducto=$(this).val();
            var CodSucursalOrigen=$("#CodSucursalOrigen").val()
            $.post("stock.php",{'CodProducto':CodProducto,CodSucursalOrigen:CodSucursalOrigen},function(data){
                $("#Cantidad").attr("max",data).val('0');
                $("#stock").html(data);
            });
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
                    $("#CodProducto").val('')
                    $("#stock").html('');
                });
            }
        });
        $(document).on("click",".eliminarfila",function(e){
            e.preventDefault();
            swal("¿Esta Seguro de Eliminar este Trapaso?",{
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
            <div class="alert alert-info">Debe seleccionar la sucursal de orígen primero</div>
            <table class="table">
                <tr>
                    <td class="text-right middle" width="30%">Sucursal de Origen</td>
                    <td><?=campo("CodSucursalOrigen","select",$suc,"form-control",1,"",1,array(),0,1);?></td>
                </tr>
                <tr>
                    <td class="text-right middle" width="30%">Sucursal de Destino</td>
                    <td><?=campo("CodSucursalDestino","select",$suc,"form-control",1,"",1,array(),0,1);?></td>
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
                        <?=campo("CodProducto","select",array(),"form-control",0,"",1,array(),0,1);?>
                    </td>
                    <td><input type="number" name="Cantidad" id="Cantidad" class="form-control der" min="0" step="1" value="0"><br>
                        <div>
                                <strong>Stock: <span class="badge badge-danger" id="stock"></span>
                                </strong>

                        </div>
                    </td>
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
            <input type="submit" value="Confirmar Traspaso" class="btn btn-primary">
        </form>
    </div>
</div>
<?php require_once($folder."pie.php");?>