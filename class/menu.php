<?php
include_once("bd.php");
class menu extends bd{
	var $tabla="menu";
	function mostrar($Nivel,$Posicion=""){
		$this->campos=array('CodMenu','Nombre','Url','Icono');
		$Posicion=(!empty($Posicion))?" and Posicion='$Posicion'":"";
		switch($Nivel){
			case "1":{return $this->getRecords(" SuperAdmin=1 and Activo=1 $Posicion","Orden");}break;
			case "2":{return $this->getRecords(" Administrador=1 and Activo=1 $Posicion","Orden");}break;
			case "3":{return $this->getRecords(" Vendedor=1 and Activo=1 $Posicion","Orden");}break;
			case "4":{return $this->getRecords(" Cliente=1 and Activo=1 $Posicion","Orden");}break;
		}
	}
	function verificar($Directorio,$Nivel){
		switch($Nivel){
			case "1":{return $this->getRecords("Url='$Directorio' and SuperAdmin=1 and Activo=1","Orden");}break;
			case "2":{return $this->getRecords("Url='$Directorio' and  Administrador=1 and Activo=1","Orden");}break;
			case "3":{return $this->getRecords("Url='$Directorio' and  Vendedor=1 and Activo=1","Orden");}break;
			case "4":{return $this->getRecords("Url='$Directorio' and  Cliente=1 and Activo=1","Orden");}break;
		}
	}
	function mostrarMenuUrl($Url=""){
		$this->campos=array('CodMenu','Nombre','Url','SubMenu','Imagen');
		$Posicion=(!empty($Posicion))?" and Posicion='$Posicion'":"";
		return $this->getRecords(" Url='$Url' and Activo=1 $Posicion","Orden");
	}
}
?>