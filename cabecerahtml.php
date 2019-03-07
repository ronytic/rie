<?php
if($_SESSION['NivelAcceso']!=4){
    include("class/usuario.php");
    $usuario=new usuario;
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
switch ($_SESSION['NivelAcceso']) {
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
}

$cargo="sd";
//$foto=$datosusu['Foto']!=""?$datosusu['Foto']:"general.jpg";

include("class/menu.php");
$menu=new menu;
include("class/submenu.php");
$submenu=new submenu;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ronald Franz Nina Layme">
    <meta name="description" content="Sistema de Administración de Red Internacional Empresarial">
    <meta name="keywords" content="Sistema de Administración de Red Internacional Empresarial, RIE">

    <title>Sistema Contable - SISCON</title>
    <link rel="icon" href="<?php echo $folder?>imagenes/favicon.ico" type="image/x-icon" />
    <link href="<?php echo $folder?>css/core/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $folder?>css/core/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo $folder?>css/core/animate.css" rel="stylesheet">
    <link href="<?php echo $folder?>css/core/style.css" rel="stylesheet">
    <link href="<?php echo $folder?>css/core/core.css" rel="stylesheet">
    <link href="<?php echo $folder?>css/core/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">


    <script src="<?php echo $folder?>js/core/jquery-2.1.1.js"></script>
