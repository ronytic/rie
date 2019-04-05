<?php
include_once("bd.php");
define("CLASESUBMENU",1);
class submenu extends bd{
	var $tabla="submenu";
	function mostrar($Nivel,$Menu){
		$this->campos=array('Nombre','Url','Icono');
		switch($Nivel){
			case "1":{return $this->getRecords(" SuperAdmin=1 and CodMenu=$Menu and Activo=1","Orden");}break;
			case "2":{return $this->getRecords(" Administrador=1 and CodMenu=$Menu and Activo=1","Orden");}break;
			case "3":{return $this->getRecords(" Vendedor=1 and CodMenu=$Menu and Activo=1","Orden");}break;
			case "4":{return $this->getRecords(" Cliente=1 and CodMenu=$Menu and Activo=1","Orden");}break;
		}
	}
	function inicio($Nivel,$Menu){
		$this->campos=array('Nombre','Url','Icono');
		switch($Nivel){
			case "1":{return $this->getRecords("Inicio!=0 and SuperAdmin=1 and CodMenu=$Menu and Activo=1","Inicio");}break;
			case "2":{return $this->getRecords("Inicio!=0 and Administrador=1 and CodMenu=$Menu and Activo=1","Inicio");}break;
			case "3":{return $this->getRecords("Inicio!=0 and Vendedor=1 and CodMenu=$Menu and Activo=1","Inicio");}break;
			case "4":{return $this->getRecords("Inicio!=0 and Cliente=1 and CodMenu=$Menu and Activo=1","Inicio");}break;
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
}
?>