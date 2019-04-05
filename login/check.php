<?php
session_start();
$dir=dirname(__FILE__).DIRECTORY_SEPARATOR."../";
define("RAIZ",$dir);
include_once(RAIZ."configuracion.php");
//include_once(RAIZ."rastreo/revisar.php");
if(!(isset($_SESSION["LoginSistemaRie"]) && $_SESSION['LoginSistemaRie']==1)){
	include_once(RAIZ."funciones/url.php");
	header("Location:".url_base().$directory."login/?u=".$_SERVER['PHP_SELF']);
}else{
	include_once(RAIZ."funciones/url.php");
	include_once(RAIZ."funciones/funciones.php");
	include_once(RAIZ."class/menu.php");
	$menu=new menu();
	$s_url= separar_url($directory,url_sub());
	$res_menu=$menu->obtenerOpcion($s_url[0]);
	setcookie("Opcion","asd",time()-1);
    setcookie("Opcion",$res_menu['CodMenu']);
}
?>