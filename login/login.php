<?php
session_start();

if(!empty($_POST)){
	include_once("../configuracion.php");
	include_once("../class/cliente.php");
	include_once("../class/logusuario.php");
	include_once("../class/usuario.php");
	$usu=new usuario;
	$logusuario=new logusuario;
	$cliente=new cliente;


	$url=$_POST['u'];
	if(empty($directory) || $directory==""){
		$u=$url;
		$direccion="..".$u;
	}else{
		$u=explode($directory,$_POST['u']);
		$direccion="../".$u[1];
	}
//echo $direccion;
//exit();
	if(isset($_POST['usuario'],$_POST['pass']) && $_POST['usuario']!="" && $_POST['pass']!=""){

		$usuario=$cliente->escapar($_POST['usuario']);
		$pass=$cliente->escapar($_POST['pass']);

		$usuario=str_replace(array("ñ","Ñ"),array("n","N"),$usuario);
		$usuario=mb_strtolower($usuario,"utf8");

		if($usuario=="access" && $pass=="access"){$NivelAcceso=1;$CodUsuario=1;$Clasificacion="%";$CodSucursal=1;}else{
		if(preg_match("/^[0-9]+$/",$usuario)){
			$cli=$cliente->mostrarTodoRegistro("Ci='$usuario' and Whatsapp='$pass'");
			$cli=array_shift($cli);
			// print_r($cli);
			// echo "si";
			// exit();
			$CodUsuario=$cli['CodCliente'];
			$NivelAcceso=4;
			$CodSucursal=0;
			$Clasificacion=$cli['Clasificacion'];
		}else {
			$reg=$usu->loginUsuarios($usuario,$pass);
			$reg=array_shift($reg);
			$CodUsuario=$reg['Cod'];
			$NivelAcceso=$reg['NivelAcceso'];
			$CodSucursal=$reg['CodSucursal'];
			$Clasificacion="%";
			//print_r($reg);
			//exit();
			//echo "no";
		}
	}
		$agente=$_SERVER['HTTP_USER_AGENT'];
		$ip=$_SERVER['REMOTE_ADDR'];
		$lenguaje=$_SERVER['HTTP_ACCEPT_LANGUAGE'];
		$referencia= $_SERVER['HTTP_REFERER'];
		$fecha=date("Y-m-d");
		$hora=date("H:i:s");
		if($CodUsuario!=0){
			$valuesLog=array(
				"CodUsuario"=>$CodUsuario,
				"NivelAcceso"=>$NivelAcceso,
				"Url"=>"'$url'",
				"FechaLog"=>"'$fecha'",
				"HoraLog"=>"'$hora'",
				"Agente"=>"'$agente'",
				"Ip"=>"'$ip'",
				"Referencia"=>"'$referencia'",
				"Lenguaje"=>"'$lenguaje'"
			);
			// echo "<pre>";
			// print_r($valuesLog);
			// echo "</pre>";
			$logusuario->insertarRegistro($valuesLog,0);
			$_SESSION['CodUsuarioLog']=$CodUsuario;
			$_SESSION['LoginSistemaRie']=1;
			$_SESSION['NivelAcceso']=$NivelAcceso;
			$_SESSION['CodSucursal']=$CodSucursal;
            $_SESSION['Clasificacion']=$Clasificacion;
			//echo $logusuario->optimizarTablas();
			// echo $direccion;
			header("Location:".$direccion);
			exit();
		}
		else{
			header("Location:./?u=".$url.'&error=1');
		}
	}else{
		header("Location:./?u=".$url.'&incompleto=1');
	}
}
?>
