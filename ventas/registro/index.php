<?php
require_once("../../login/check.php");
//

// setcookie("opcion","")
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
$cate=$categoria->mostrarTodoRegistro("",1,"Orden");
$cat=todoLista($cate,"CodCategoria","Nombre");
include_once("../../class/marca.php");
$marca=new marca;
$marc=$marca->mostrarTodoRegistro("",1,"Orden");
$mar=todoLista($marc,"CodMarca","Nombre");

include_once("../../class/cliente.php");
$cliente=new cliente;
$clie=$cliente->mostrarTodoRegistro("",1,"Apellidos,Nombres");
$cli=todoLista($clie,"CodCliente","Ci,Apellidos,Nombres","  ");


include_once("../../class/producto.php");
$producto=new producto;
$prod=$producto->mostrarTodoRegistro("",1,"");
$prod=todoLista($prod,"CodProducto","Nombre,Codigo"," - ");



$titulo="Registro de Venta";
$folder="../../";
?>
<?php require_once($folder."cabecerahtml.php");?>
<?php

?>
<script>
    let l=0;
    $(document).ready(function(){
        $("#CodCliente").select2();
        $("#CodProducto").select2();
        // alert("s");
        $("#CodCategoria,#CodMarca").change(function(e){
            var CodCategoria=$("#CodCategoria").val();
            var CodMarca=$("#CodMarca").val();
            if($("#CodSucursal").val()==""){
                swal("Seleccionar una sucursal de origen",{buttons: {confirm: {text:"Aceptar",value:'ok'}}});
                e.preventDefault();
            }else{
                $.post("obtenerproducto.php",{CodCategoria:CodCategoria,CodMarca:CodMarca},function(data){
                    $("#CodProducto").html(data);
                    $("#CodProducto").select2();
                });
            }
        });
        $(document).on("focus","#Precio,#Cantidad",function(){
            $(this).select();
        });
        $(document).on("change","#CodProducto",function(){
            var CodProducto=$(this).val();
            var CodSucursal=$("#CodSucursal").val();
            var CodCliente=$("#CodCliente").val();
            if($("#CodCliente").val()==""){
                swal("Debes seleccionar un cliente ",{buttons: {confirm: {text:"Aceptar",value:'ok'}}});
                $("#CodProducto").val('')
                return false;
            }
            $.post("stock.php",{'CodProducto':CodProducto,CodSucursal:CodSucursal,CodCliente:CodCliente},function(data){
                $("#Cantidad").attr("max",data.stock).val('0');
                $("#stock").html(data.stock);
                $("#CuadroColor").css("backgroundColor",data.Color);
                $("#Caracteristicas").html(data.Caracteristicas);
                $("#Calidad").html(data.Calidad);
                $("#Codigo").html(data.Codigo);
                if( data.Foto!=""  ){
                    $("#FotoProducto").attr("href",'../../imagenes/productos/'+data.Foto).show();
                }else{
                    $("#FotoProducto").hide();
                }
                $("#Precio").attr("max",data.precio).val(data.precio);
            },"json");

        });

        $(document).on("change","#CodCliente",function(){
            var CodCliente=$(this).val();

            $.post("verfoto.php",{'CodCliente':CodCliente},function(data){
                $("#Foto").html(data);
            });

        });

        $(document).on("change keyup","#Cantidad,#Precio",function(e){
            var Cantidad=parseInt($("#Cantidad").val());
            var Precio=parseFloat($("#Precio").val());
            var Total=Cantidad*Precio;
            $("#Total").val(Total.toFixed(2));

        });
        $("#aumentar").click(function (e) {
            e.preventDefault();
            //alert($("#CodProducto >option:selected").html());
            var CodProducto=$("#CodProducto").val();
            var Cantidad=$("#Cantidad").val();
            var Precio=$("#Precio").val();
            var Total=$("#Total").val();
            $("#Cantidad").val(0)
            var Detalle=$("#Detalle").val();
            if($("#CodCliente").val()==""){
                swal("Debes seleccionar un cliente ",{buttons: {confirm: {text:"Aceptar",value:'ok'}}});
                return false;
            }
            if(CodProducto!=""){

                if(parseInt(Cantidad)>parseInt($("#stock").html()) || parseInt(Cantidad)<=0){
                    swal("Debes Introducir una Cantidad Correcta",{buttons: {confirm: {text:"Aceptar",value:'ok'}}});
                }else{
                    if(parseFloat(Precio)<0 || Precio=="" ){
                        swal("Debes Introducir un Precio Correcto",{buttons: {confirm: {text:"Aceptar",value:'ok'}}});

                    }else{
                        l++;
                        $.post("guardarproducto.php",{"l":l,"CodProducto":CodProducto,Cantidad:Cantidad,Precio:Precio,Total:Total,Detalle:Detalle},function(data){
                            $("#marca").append(data);
                            sumar();
                            $("#Detalle").val('');
                            $("#stock").html('')
                            $("#CodProducto").val('')
                            $("#CuadroColor").css("backgroundColor","transparent");
                            $("#Caracteristicas").html('');
                            $("#Calidad").html('');
                            $("#Codigo").html('');
                            $("#Foto").hide('slow');


                        });
                    }
                }
            }else{
                swal("Debes seleccionar un Producto",{buttons: {confirm: {text:"Aceptar",value:'ok'}}});

            }
        });
        $(document).on("change keyup","#Cancelado",function(){
            var TotalGeneral=parseFloat($("#TotalGeneral").val());
            var Cancelado=parseFloat($(this).val());
            var Cambio=Cancelado - TotalGeneral;
            $("#Cambio").val(Cambio.toFixed(2)).removeClass("irojo iverde").addClass((Cambio<0)?" irojo":" iverde");
        });

        $('#btn-submit').on('click',function(e){
            e.preventDefault();
            //alert($('form').serialize());
            if($("#Cambio").val()=="" || $("#Cambio").val()<0){
                swal("El Cambio es Incorrecto",{buttons: {confirm: {text:"Aceptar",value:'ok'}}});
                return false;
            }
            var form = $(this).parents('form');
            swal("¿Esta seguro de realizar esta venta?",{
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
                        form.submit();
                    }break;
                    default:{
                        e.preventDefault();
                        return false;
                    }break;
                }
            });
        });
        /*$(document).on("submit","#formularioventa",function(e){
            e.preventDefault();

            swal("¿Esta seguro de realizar esta venta?",{
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
                        $("#formularioventa").off("submit").submit();
                    }break;
                    default:{

                        return false;
                    }break;
                }
            });
        });*/
        $(document).on("click",".eliminarfila",function(e){
            e.preventDefault();
            swal("¿Esta Seguro de Eliminar este Producto de la Preventa?",{
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
                        sumar();
                    }break;
                }
            });
        });
    });
    function sumar(){
        var totales=0;
        $(".totales").each(function(i,e) {

            totales+=parseFloat($(this).html());
        });
        //alert(totales);
        $(".totalgeneral1").val(totales.toFixed(2));
    }
    function listarproducto() {
        $.post("listadoproductos.php",{"CodProducto":CodProducto,Cantidad:Cantidad,Detalle:Detalle},function(data){

        });
    }
</script>
<style type="text/css">
#cuadrostock{
    top:0;
    left:0;
    position:absolute;
}
</style>
<?php require_once($folder."cabecera.php");?>
<div class="panel">
    <div class="panel-heading"><h3></h3></div>
    <div class="panel-body">
        <form action="guardar.php" method="post" id="formularioventa">
            <div class="alert alert-info">Debe seleccionar la sucursal y el cliente</div>
            <table class="table">
                <tr>
                    <td class="text-right middle col-lg-4" width="30%">Sucursal</td>
                    <td class="col-lg-4">

                    <?php
                        if(!in_array( $_SESSION['NivelAcceso'],array(1,2))){
                            $val="disabled";
                            echo campo("CodSucursal","hidden",$_SESSION['CodSucursal']);
                        }else{
                            $val="";
                        }
                        ?>
                        <?=campo("CodSucursal","select",$suc,"form-control",1,"",1,array($val=>$val),$_SESSION['CodSucursal'],0);?>

                    </td>
                    <td class="col-lg-4"></td>
                </tr>
                <tr>
                    <td class="text-right middle" width="30%">Cliente</td>
                    <td><?=campo("CodCliente","select",$cli,"form-control",1,"",0,array(),"",1);?></td>
                    <td id="Foto"></td>
                </tr>
            </table>
            <table class="table table-bordered table-hover ">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th width="50%">Cantidad</th>

                    </tr>
                </thead>
                <tbody >
                <tr>
                    <td class="small">
                        <?=campo("CodCategoria","select",$cat,"form-control input-sm",1,"",0,array(),0,1);?>
                        <?=campo("CodMarca","select",$mar,"form-control",1,"",0,array(),0,1);?>
                        <?=campo("CodProducto","select",$prod,"form-control",1,"",0,array(),0,1);?>
                        <table class="table table-bordered">
                            <tr>
                                <td class="der resaltar" width="40%">Color: </td>
                                <td><div style="width:20px;height:20px;" id="CuadroColor"></div></td>
                            </tr>
                            <tr>
                                <td class="der resaltar">Caracteristicas: </td>
                                <td id="Caracteristicas"></td>
                            </tr>
                            <tr>
                                <td class="der resaltar">Calidad: </td>
                                <td id="Calidad"></td>
                            </tr>
                            <tr>
                                <td class="der resaltar">Código: </td>
                                <td id="Codigo"></td>
                            </tr>
                            <tr>
                                <td class="der resaltar">Foto: </td>
                                <td >

                                        <a href="#" id="FotoProducto" class="btn btn-info btn-xs" style="display:none;" target="_blank"> <i class="fa fa-image"></i></a>

                                </td>
                            </tr>
                        </table>
                        <div style="width:20px;height:20px;" ></div>
                    </td>
                    <td style="position:relative"><input type="number" name="Cantidad" id="Cantidad" class="form-control der" min="0" step="1" value="0" max="">
                        <div id="cuadrostock">
                                <strong><span class="badge badge-danger" id="stock"></span></strong>
                        </div>
                        <div>
                            <strong>Precio</strong>
                            <input type="number" name="Precio" id="Precio" class="form-control der" min="0" step="0.01" value="0">
                        </div>
                        <div>
                            <strong>Total</strong>
                            <input type="number" name="Total" id="Total" class="form-control der" min="0" step="0.01" value="0" readonly>
                        </div>
                        <strong>Detalle de Producto</strong>
                        <input type="text" name="Detalle" id="Detalle" class="form-control"  >
                    <br>
                    <a href="#" class="btn btn-success block" id="aumentar"> <i class="fa fa-plus "></i> Agregar</a>
                        </td>
                </tr>

                </tbody>
            </table>
            <br>
            <div id="listado" class="table-responsive">
            <table class="table table-bordered table-hover ">
                <thead>
                    <tr>
                        <th width="10" style="width:10px !important;">N</th>
                        <th>Producto</th>
                        <th width="100">Cantidad</th>
                        <th width="100">Precio</th>
                        <th width="150">Total</th>

                        <th width="100">Detalle</th>
                    </tr>
                </thead>
                <tbody id="marca">
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" rowspan="2">
                            Detalle
                            <?=campo("Detalle","textarea","","form-control");?>
                        </th>
                        <th colspan="1" class="der">
                        Total
                        </th>
                        <th class="der">
                            <input type="number" class="form-control der totalgeneral1 " name="TotalGeneral" id="TotalGeneral" min="0" step="0.01" readonly>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="1" class="der">
                        Cancelado
                        </th>
                        <th class="der">
                            <input type="number" class="form-control der " name="Cancelado" id="Cancelado" min="0" step="0.01">
                        </th>
                    </tr>
                    <tr>
                        <th colspan="4" class="der">
                        Cambio
                        </th>
                        <th class="der">
                            <input type="number" class="form-control der  " name="Cambio" id="Cambio" min="0" step="0.01" readonly>
                        </th>
                    </tr>
                </tfoot>
            </table>
            </div>
            <br>
            <!-- <input type="submit" value="Confirmar Venta" class="btn btn-primary"> -->
            <input type="button" value="Confirmar Venta"  class="btn btn-primary" id="btn-submit">
        </form>
    </div>
</div>
<?php require_once($folder."pie.php");?>