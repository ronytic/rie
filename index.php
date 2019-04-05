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
    <div class="text-center">
      <a href="lista/" class="btn btn-primary btn"> <i class="fa fa-file"></i> Ver Lista Actualizada de Productos </a>
    </div>
    <br>
    <div class="row">
      <?php
        foreach($menu->inicio($_SESSION['NivelAcceso']) as $m_i){
      ?>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
        <fieldset>
          <legend><?=$m_i['Nombre'];?></legend>
            <?php
              $sm_o=0;


              foreach($submenu->mostrar($_SESSION['NivelAcceso'],$m_i['CodMenu']) as $subm_i){
                $sm_o++;
                switch($sm_o){
                  case 1:{$sm_t="success";}break;
                  case 2:{$sm_t="primary";}break;
                  case 3:{$sm_t="info";$sm_o=0;}break;
                }
            ?>
            <a href="<?=$m_i['Url'];?><?=$subm_i['Url'];?>" class="btn btn-<?=$sm_t;?>"><?=$subm_i['Nombre'];?></a>
            <br><br>
          <?php
            }
          ?>
         </fieldset>
      </div>
        <?php
          }
        ?>


      <!-- <a href="reportes/balanza/" class="btn btn-success">Balanza de Pagos</a> -->
      <!-- <a href="reportes/balanzaparcial/" class="btn btn-success">Balanza Parcial</a> -->
    </div>

  </div>
</div>
<?php require_once("pie.php");?>
