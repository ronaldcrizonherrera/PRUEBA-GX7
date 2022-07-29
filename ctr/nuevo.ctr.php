<?php
include '../files/class_empleados.php';


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
$nuevoEmpInfo = $nuevoEmp->NuevoEmpleado($nombre, $email, $sexo, $area_id, $boletin, 
$descripcion);
$id_empleado = $nuevoEmpInfo;
if ($id_empleado > 0) {
	$mensaje = "<div class='alert alert-success' role='alert'>
	Empleado: <b>".$nombre."</b> Guardado!</div>";
    echo $mensaje;
}else{
	$mensaje = "<div class='alert alert-danger' role='alert'>
	Error: El empleado <b>".$nombre."</b> NO pudo ser guardado!</div>";
    echo $mensaje; die;
}

//foreach para insertar roles
foreach ($roles_array as $key => $value) {
	$id_rol = $value;

	$nuevoRol = new EMPLEADOS();
	$nuevoRolInfo = $nuevoRol->AsociarRoles($id_empleado, $id_rol);
		
}

