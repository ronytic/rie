<?php
require_once("login/check.php");
// print_r($_SESSION);
$titulo="Principal";
$folder="";
?>
<?php require_once("cabecerahtml.php");?>
<?php require_once("cabecera.php");?>
<div class="panel">
  <div class="panel-body">
    <div class="">
      <a href="librodiario/registro/" class="btn btn-info">Lista Actualizada</a>
      <!-- <a href="librodiario/registro/" class="btn btn-danger">Listado de Diarios</a> -->
    </div>
    <br>
    <div class="">
      <!-- <a href="reportes/balanza/" class="btn btn-success">Balanza de Pagos</a> -->
      <!-- <a href="reportes/balanzaparcial/" class="btn btn-success">Balanza Parcial</a> -->
    </div>

  </div>
</div>
<?php require_once("pie.php");?>
