<?php
if($_SESSION['NivelAcceso']!=4){
    if(!defined("CLASEUSUARIO")){
        include("class/usuario.php");
        $usuario=new usuario;
    }

    $datosusu=$usuario->mostrarDatos($_SESSION['CodUsuarioLog']);
    $datosusu=array_shift($datosusu);
    $nombrecompleto=$datosusu['Nombres']." ".$datosusu['Apellidos'];
    $solonombre=$datosusu['Nombres'];
}else{
    include_once("class/cliente.php");
    $cliente=new cliente;
    $datoscli=$cliente->mostrarTodoRegistro("CodCliente=".$_SESSION['CodUsuarioLog']);
    $datoscli=array_shift($datoscli);
    $nombrecompleto=$datoscli['Nombres']." ".$datoscli['Apellidos'];
    $solonombre=$datoscli['Nombres'];
}
if(!defined("CLASEACCESO")){
include("class/acceso.php");
$acceso=new acceso;
}
$car=$acceso->mostrarTodoRegistro("CodAcceso=".$_SESSION['NivelAcceso']);
$car=array_shift($car);
    $Cargo=$car['Nombre'];
/*switch () {
    case '1':
        $Cargo="Super Administrador";
        break;
    case '2':
        $Cargo="Administrador";
        break;
    case '3':
        $Cargo="Vendedor";
        break;
    case '4':
        $Cargo="Cliente";
        break;
    default:
        $Cargo="";
        break;
}*/

if(!defined("CLASEMENU")){
    include("class/menu.php");
    $menu=new menu;
}
if(!defined("CLASESUBMENU")){
    include("class/submenu.php");
    $submenu=new submenu;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ronald Franz Nina Layme">
    <meta name="description" content="Sistema de Administración de Red Internacional Empresarial">
    <meta name="keywords" content="Sistema de Administración de Red Internacional Empresarial, RIE">

    <title>RIE</title>
    <link rel="icon" href="<?php echo $folder?>imagenes/favicon.ico" type="image/x-icon" />
    <link href="<?php echo $folder?>css/core/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $folder?>css/core/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo $folder?>css/core/animate.css" rel="stylesheet">
    <link href="<?php echo $folder?>css/core/style.css" rel="stylesheet">
    <link href="<?php echo $folder?>css/core/core.css?2" rel="stylesheet">
    <link href="<?php echo $folder?>css/core/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <link href="<?php echo $folder?>js/plugins/select2-3.5.2/select2.css" rel="stylesheet">
    <link href="<?php echo $folder?>js/plugins/select2-3.5.2/select2-bootstrap.css" rel="stylesheet">
    <link href="<?php echo $folder?>css/core/core.css?2" rel="stylesheet">

    <script src="<?php echo $folder?>js/core/jquery-2.1.1.js"></script>
    <script src="<?php echo $folder?>js/core/general.js"></script>
    <script src="<?php echo $folder?>js/plugins/swal/sweetalert.min.js"></script>