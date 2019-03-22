<?php
    require_once("../../login/check.php");
    $CodCategoria=$_POST['CodCategoria'];
    $CodMarca=$_POST['CodMarca'];
    include_once("../../class/producto.php");
    $producto=new producto;
    $pro=$producto->mostrarTodoRegistro("CodCategoria=$CodCategoria and CodMarca=$CodMarca",1,"Nombre");
    ?>
    <option value="">Seleccionar</option>
    <?php
    foreach($pro as $p){
        ?>
        <option value="<?=$p['CodProducto'];?>"><?=$p['Nombre'];?></option>
        <?php
    }
?>
