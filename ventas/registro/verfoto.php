<?php
require_once("../../login/check.php");

$CodCliente=$_POST['CodCliente'];



require_once("../../class/cliente.php");
$cliente=new cliente;
$cli=$cliente->mostrarTodoRegistro("CodCliente=".$CodCliente);
$cli=array_shift($cli);
$Foto=$cli['Foto'];

if(!empty($Foto)){
    ?>
    <a href="../../imagenes/clientes/<?=$Foto;?>" target="_blank" class="btn btn-success btn-xs">
        <i class="fa fa-image"></i>
    </a>
    <?php
};
?>