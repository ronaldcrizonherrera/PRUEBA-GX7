<?php
include '../files/class_empleados.php';


$id_empleado = $_POST['id_empleado'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$sexo = $_POST['sexo'];
$descripcion = $_POST['descripcion'];
$area_id = $_POST['area'];

if (isset($_POST['boletin'])) {
	$boletin = 1;
}else{
	$boletin = 0;
}

$roles_array = $_POST['rol'];


$nuevoEmp = new EMPLEADOS();
$nuevoEmpInfo = $nuevoEmp->ActualizarEmpleado($id_empleado, $nombre, $email, $sexo, $area_id, $boletin, 
$descripcion);

//Eliminamos los roles
$deleteRol = new EMPLEADOS();
$deleteRolInfo = $deleteRol->EliminarRolesEmpleado($id_empleado);

//foreach para insertar roles
foreach ($roles_array as $key => $value) {
	$id_rol = $value;

	$nuevoRol = new EMPLEADOS();
	$nuevoRolInfo = $nuevoRol->AsociarRoles($id_empleado, $id_rol);
		
}

$mensaje = "<div class='alert alert-warning' role='alert'>
La pagina se actualizara en 3 segundos!</div>";
echo $mensaje;

$recargar = "<script> setTimeout('location.reload()', 4000); </script>";
echo $recargar;