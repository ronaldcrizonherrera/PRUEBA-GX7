<?php
/***************************************************************
/***************************************************************
/*********** Desarrollador: Ing Ronald Crizon*******************
/*********** Año: 2018	****************************************
/***************************************************************
/***************************************************************
/***************************************************************
/***************************************************************
****************************************************************/
class Conectar
{
	
	public function get_conexion()
	{

		
		$user='root';
		$pass='';
		$host='localhost';
		$db='test_gx7';

		$conexion = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
		return $conexion;
		
		


		//CONFIG SERVER
        /*
		$user='webimsol_rch';
		$pass='Ronald1047424636';
		$host='localhost';
		$db='webimsol_konecta';*/
		

		$conexion = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
		return $conexion;
		

	}
}

?>