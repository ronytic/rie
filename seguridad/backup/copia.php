<?php
require_once("../../login/check.php");
require_once("../../basededatos.php");

require_once("myphp-backup.php");
$archivo=$backupDatabase->archivofinal;

?>
<a href="<?=$archivo;?>" class="btn btn-danger" download>Descargar Archivo</a>
