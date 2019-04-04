<?php
require_once("../../login/check.php");
// print_r($_SESSION);
$titulo="Copia de Seguridad";
$folder="../../";
?>

<?php require_once("../../cabecerahtml.php");?>
<script>
$(document).ready(function(){
    $("#enlacebackup").click(function (e) {
        e.preventDefault();
        $.post("copia.php",{},function(data){
            $("#destino").html(data);
        });
    });
});
</script>
<?php require_once("../../cabecera.php");?>
<div class="panel">
  <div class="panel-body">
    <div class="text-center">
      <a href="#" class="btn btn-success btn" id="enlacebackup"> <i class="fa fa-file"></i> Obtener  Archivo de Copia de Seguridad</a>
    </div>
    <br>
    <div class="" id="destino">

    </div>

  </div>
</div>
<?php require_once("../../pie.php");?>
