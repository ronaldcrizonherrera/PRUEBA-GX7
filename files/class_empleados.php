<?php
require_once("class.php");
require_once("functions.php");

class EMPLEADOS
{
	private $datos=array();
	//======================================================================
	public function NuevoEmpleado($nombre, $email, $sexo, $area_id, $boletin, $descripcion)
		{
			$modelo = new Conectar();
			$conexion = $modelo -> get_conexion();

			$hoy = date("Y-m-d");

			$sqlUpdate= " INSERT INTO empleado 
						  ( 
						  nombre, 
						  email, 
						  sexo, 
						  area_id, 
						  boletin, 
						  descripcion  
						  ) 
						  VALUES 
						  (
						  :nombre, 
						  :email, 
						  :sexo, 
						  :area_id, 
						  :boletin, 
						  :descripcion  
						  )";
			$sth3 = $conexion->prepare($sqlUpdate);
			$sth3->bindParam(':nombre', $nombre);
			$sth3->bindParam(':email', $email);
			$sth3->bindParam(':sexo', $sexo);
			$sth3->bindParam(':area_id', $area_id);
			$sth3->bindParam(':boletin', $boletin);
			$sth3->bindParam(':descripcion', $descripcion);
			$sth3->execute();
			$lastInsertId = $conexion->lastInsertId();
			return $lastInsertId;
		    
		}


	//======================================================================
	public function getEmpleados()
	{
		$modelo = new Conectar();
		$conexion = $modelo -> get_conexion();

		$sql = "SELECT * FROM empleado";
		$sth = $conexion->prepare($sql);
		$sth->execute();

		while($result = $sth->fetch() )
		{
			$this->datos[]=$result;
		}
		return $this->datos; 
	}

	//Filtro
	public function getEmpleadoFiltro($parametro)
{
	$modelo = new Conectar();
	$conexion = $modelo -> get_conexion();
	$sql = "SELECT * FROM empleado WHERE 
	(empleado.nombre LIKE  '%$parametro%' OR empleado.email LIKE  '%$parametro%')";
	$sth = $conexion->prepare($sql);
	$sth->execute();
	while($result = $sth->fetch() )
	{
		$this->datos[]=$result;
	}
	return $this->datos; 
}



	public function getEmpleado($id)
{
	$modelo = new Conectar();
	$conexion = $modelo -> get_conexion();
	$sql = "SELECT * FROM empleado WHERE empleado.id=".$id;
	$sth = $conexion->prepare($sql);
	$sth->execute();
	while($result = $sth->fetch() )
	{
		$this->datos[]=$result;
	}
	return $this->datos; 
}



	public function getAreaEmpleado($id_area)
{
	$modelo = new Conectar();
	$conexion = $modelo -> get_conexion();
	$sql = "SELECT * FROM areas WHERE areas.id=".$id_area;
	$sth = $conexion->prepare($sql);
	$sth->execute();
	while($result = $sth->fetch() )
	{
		$this->datos[]=$result;
	}
	return $this->datos; 
}

	public function getAreasEmpleados()
{
	$modelo = new Conectar();
	$conexion = $modelo -> get_conexion();
	$sql = "SELECT * FROM areas";
	$sth = $conexion->prepare($sql);
	$sth->execute();
	while($result = $sth->fetch() )
	{
		$this->datos[]=$result;
	}
	return $this->datos; 
}


	public function getRoles()
{
	$modelo = new Conectar();
	$conexion = $modelo -> get_conexion();
	$sql = "SELECT * FROM roles";
	$sth = $conexion->prepare($sql);
	$sth->execute();
	while($result = $sth->fetch() )
	{
		$this->datos[]=$result;
	}
	return $this->datos; 
}


	public function getRolesEmpleado($id_empleado)
{
	$modelo = new Conectar();
	$conexion = $modelo -> get_conexion();
	$sql = "SELECT empleado_rol.rol_id AS id_rol, roles.nombre AS nombre_rol 
	FROM empleado_rol 
	INNER JOIN roles ON empleado_rol.rol_id = roles.id WHERE 
	empleado_rol.empleado_id = $id_empleado";
	$sth = $conexion->prepare($sql);
	$sth->execute();
	while($result = $sth->fetch() )
	{
		$this->datos[]=$result;
	}
	return $this->datos; 
}

	public function get_Rol_Empleado($id_empleado, $id_rol)
{
	$modelo = new Conectar();
	$conexion = $modelo -> get_conexion();
	$sql = "SELECT empleado_rol.rol_id AS id_rol, roles.nombre AS nombre_rol 
	FROM empleado_rol 
	INNER JOIN roles ON empleado_rol.rol_id = roles.id WHERE 
	empleado_rol.empleado_id = $id_empleado AND empleado_rol.rol_id = $id_rol";
	$sth = $conexion->prepare($sql);
	$sth->execute();
	while($result = $sth->fetch() )
	{
		$this->datos[]=$result;
	}
	return $this->datos; 
}


	public function get_Rol($id_rol)
{
	$modelo = new Conectar();
	$conexion = $modelo -> get_conexion();
	$sql = "SELECT roles.nombre AS nombre_rol FROM roles WHERE roles.id = $id_rol";
	$sth = $conexion->prepare($sql);
	$sth->execute();
	while($result = $sth->fetch() )
	{
		$this->datos[]=$result;
	}
	return $this->datos; 
}



//======================================================================
	public function ActualizarEmpleado($id, $nombre, $email, $sexo, $area_id, $boletin, 
	$descripcion)
		{
			$modelo = new Conectar();
			$conexion = $modelo -> get_conexion();

			$sqlUpdate= "
			UPDATE empleado SET 
			nombre = :nombre, 
			email = :email, 
			sexo = :sexo, 
			area_id  = :area_id , 
			boletin = :boletin, 
			descripcion = :descripcion 
			WHERE 
			id = :id
			";
			$sth3 = $conexion->prepare($sqlUpdate);
			$sth3->bindParam(':nombre', $nombre);
			$sth3->bindParam(':email', $email);
			$sth3->bindParam(':sexo', $sexo);
			$sth3->bindParam(':area_id', $area_id);
			$sth3->bindParam(':boletin', $boletin);
			$sth3->bindParam(':descripcion', $descripcion);
			$sth3->bindParam(':id', $id);
			$sth3->execute();

		    $mensaje = "<div class='alert alert-success' role='alert'>
			  Empleado: <b>".$nombre."</b> Actualizado!</div>";
            echo $mensaje;
		}


//======================================================================
		public function EliminarRolesEmpleado($id_empleado)
		{
			$modelo = new Conectar();
			$conexion = $modelo -> get_conexion();

			$sqlUpdate= "DELETE FROM empleado_rol WHERE empleado_id = :empleado_id";
			$sth3 = $conexion->prepare($sqlUpdate);
			$sth3->bindParam(':empleado_id', $id_empleado);
			$sth3->execute();
		}


		public function EliminarEmpleado($id_empleado)
		{
			$modelo = new Conectar();
			$conexion = $modelo -> get_conexion();

			$sqlUpdate= "DELETE FROM empleado WHERE id = :empleado_id";
			$sth3 = $conexion->prepare($sqlUpdate);
			$sth3->bindParam(':empleado_id', $id_empleado);
			$sth3->execute();
		}


//======================================================================
	public function AsociarRoles($id_empleado, $id_rol)
		{
			$modelo = new Conectar();
			$conexion = $modelo -> get_conexion();

			$sqlUpdate= " INSERT INTO empleado_rol 
						  ( 
						  empleado_id, 
						  rol_id
						  ) 
						  VALUES 
						  (
						  :empleado_id, 
						  :rol_id
						  )";
			$sth3 = $conexion->prepare($sqlUpdate);
			$sth3->bindParam(':empleado_id', $id_empleado);
			$sth3->bindParam(':rol_id', $id_rol);
			$sth3->execute();
		}



//END CLASS ARTICULOS
}
