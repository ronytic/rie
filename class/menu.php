<?php
include_once("bd.php");
define("CLASEMENU",1);
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
	function inicio($Nivel,$Posicion=""){
		$this->campos=array('CodMenu','Nombre','Url','Icono');
		$Posicion=(!empty($Posicion))?" and Posicion='$Posicion'":"";
		switch($Nivel){
			case "1":{return $this->getRecords("Inicio!=0 and SuperAdmin=1 and Activo=1 $Posicion","Inicio");}break;
			case "2":{return $this->getRecords("Inicio!=0 and Administrador=1 and Activo=1 $Posicion","Inicio");}break;
			case "3":{return $this->getRecords("Inicio!=0 and Vendedor=1 and Activo=1 $Posicion","Inicio");}break;
			case "4":{return $this->getRecords("Inicio!=0 and Cliente=1 and Activo=1 $Posicion","Inicio");}break;
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
	function obtenerOpcion($Nombre){
		$r=$this->getRecords(" Nombre LIKE '%$Nombre%' and Activo=1 ","");
		$r=array_shift($r);
		return $r;
	}
	function mostrarMenuUrl($Url=""){
		$this->campos=array('CodMenu','Nombre','Url','SubMenu','Imagen');
		$Posicion=(!empty($Posicion))?" and Posicion='$Posicion'":"";
		return $this->getRecords(" Url='$Url' and Activo=1 $Posicion","Orden");

	}
}
?>