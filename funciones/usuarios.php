<?php

function DatosUsuario($Nivel,$CodUsuario){
	global $idioma;
	include_once("../../class/logusuario.php");
	include_once("../../class/usuario.php");
	$logusuario=new logusuario;
	$usuario=new usuario;
	
	
		$Usuario=$idioma["Administrador"];
					$ul=$usuario->mostrarDatos($CodUsuario);
					$ul=array_shift($ul);
					$tipousuario=$idioma['Administrador'];
					$Foto=$folder."imagenes/usuario/".$ul['Foto'];
					$Paterno=$ul['Paterno'];
					$Materno=$ul['Materno'];
					$Nombres=$ul['Nombres'];
		
	$retorno=array("TipoUsuario"=>$tipousuario,
		"Foto"=>$Foto,
		"Paterno"=>$Paterno,
		"Materno"=>$Materno,
		"Nombres"=>$Nombres,
		
	);
	return $retorno;
}
?>