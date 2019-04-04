<?php
include_once("bd.php");
define("CLASEUSUARIO",1);
class usuario extends bd{
	var $tabla="usuario";
	function mostrarDatos($CodUsuario){
		$this->campos=array("*");
		return $this->getRecords("Cod=$CodUsuario and Activo=1");
	}
	function mostrarUsuarios($menos=""){
		$menos=$menos?"$menos and ":'';
		$this->campos=array("*");
		return $this->getRecords("$menos Activo=1","Paterno,Materno,Nombres");
	}
	function actualizarDatos($valores,$CodUsuario){
		//print_r($valores);
		return $this->updateRow($valores,"Cod=$CodUsuario");
	}

	function loginUsuarios($Usuario,$Password){
		$this->campos=array("count(*) as Can,Cod,NivelAcceso,CodSucursal");
		return $this->getRecords("Usuario='$Usuario' and Contrasena=SHA1('$Password') and Activo=1");
	}
}
?>
