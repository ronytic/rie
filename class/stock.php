<?php
include_once("bd.php");
class stock extends Bd{
	var $tabla="";
	public function obtener($CodProducto,$CodSucursal="%"){
		// SELECT (SELECT IFNULL(SUM(Cantidad),0) as CantidadIngreso FROM `ingreso` WHERE CodProducto=4 and CodSucursal=3) - (SELECT IFNULL(SUM(Cantidad),0) as CantidadSalida FROM `salida` WHERE CodProducto=4 and CodSucursal=3) as Stock

		$consulta="SELECT (SELECT IFNULL(SUM(Cantidad),0) as CantidadIngreso FROM `ingreso` WHERE CodProducto=$CodProducto and CodSucursal LIKE '$CodSucursal' and Estado='Activo')
							-
							 (SELECT IFNULL(SUM(Cantidad),0) as CantidadSalida FROM `salida` WHERE CodProducto=$CodProducto and CodSucursal LIKE '$CodSucursal' and Estado='Activo')

							 as Stock";
							//  echo $consulta;
		return $this->ejecutar($consulta);
	}
}
?>