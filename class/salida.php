<?php
include_once("bd.php");
class salida extends Bd{
	var $tabla="salida";
	public function masvendido($CodSucursal,$Detalle,$CodUsuario,$Desde,$Hasta,$Estado="Activo"){

		// SELECT CodProducto,SUM(Cantidad) AS Cantidad,FechaRegistro FROM `salida`WHERE Detalle LIKE '%%' and CodUsuario LIKE '%' and CodVenta!=0 and FechaRegistro BETWEEN '2019-04-04' and '2019-04-04' and Estado='Activo' and Activo=1 Group BY CodProducto ORDER BY Cantidad DESC
		$this->campos=array("CodProducto,SUM(Cantidad) AS Cantidad,SUM(Total) as Total");
		return $this->getRecords("Detalle LIKE '%$Detalle%' and
								CodUsuario LIKE '$CodUsuario' and
								CodSucursal LIKE '$CodSucursal' and
								CodVenta!=0 and
								FechaRegistro BETWEEN '$Desde' and '$Hasta' and
								Estado='$Estado' and Activo=1",
								"Cantidad",
								"CodProducto",
								false,
								0,
								1
								);

		// ($where_str=false, $order_str=false,$group_str=false, $count=false, $start=0, $order_strDesc=false)
	}
}
?>