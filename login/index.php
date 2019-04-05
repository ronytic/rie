<?php
$folder="../";
require_once("../configuracion.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ronald Franz Nina Layme">
    <meta name="description" content="Sistema de Administración para Red Internacional Empresarial Bolivia - Diseñado por Ronald Nina Layme">
    <meta name="keywords" content="rie,sistema de administración,compra de celulares,">
    <title>RIE</title>
    <link rel="icon" href="<?php echo $folder;?>imagenes/favicon.ico" type="image/x-icon" />
    <link href="<?php echo $folder;?>css/core/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $folder;?>css/core/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo $folder;?>css/core/animate.css" rel="stylesheet">
    <link href="<?php echo $folder;?>css/core/style.css" rel="stylesheet">
    <?php
        echo $CodigoNotificación;
    ?>

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <img src="../imagenes/logo/logo.jpg" class="img-thumbnail" alt="">
            </div>
            <h3>Sistema Administrativo</h3>
            <p>
            </p>

            <?php if(isset($_GET['incompleto'])){?>
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Los Datos Introducidos se encuentran Incompletos
            </div>
            <?php }?>
            <?php if(isset($_GET['error'])){?>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Los Datos Introducidos son erroneos, Verifique y vuelva a Intentarlo
            </div>
            <?php }?>
            <form class="m-t" role="form" action="login.php" method="post">
                <input type="hidden" name="u" value="<?php echo isset($_GET['u'])?$_GET['u']:'';?>" />
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Usuario" required="" autofocus name="usuario">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Contraseña" required="" name="pass">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Acceder</button>


            </form>
            <p class="m-t"> <small>Sistema de Administración  &copy; <?=date("Y")!="2019"?'2019':'';?> <?php echo date("Y")?></small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo $folder;?>js/core/jquery-2.1.1.js"></script>
    <script src="<?php echo $folder;?>js/core/bootstrap.min.js"></script>
    <script>
      $(document).ready(function() {
        $("[name=usuario]").focus();
        $("[name=usuario]").keydown(function(event) {
          if(event.which==32){
            event.preventDefault();
          }
          $("[name=usuario]").val(($("[name=usuario]").val()).toLowerCase())
          //alert(event.which);
        });
      });
    </script>
</body>
</html>
