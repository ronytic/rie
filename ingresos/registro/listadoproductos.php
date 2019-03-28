<?php
// No Utilizado
include_once("../../login/check.php");
include_once("../../class/categoria.php");
$categoria=new categoria;
$cate=$categoria->mostrarTodoRegistro("",1,"Nombre");
?>