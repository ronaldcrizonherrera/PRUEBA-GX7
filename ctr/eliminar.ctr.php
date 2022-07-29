<?php
include '../files/class_empleados.php';

$id_emp = $_GET["id"];

$deleteRol = new EMPLEADOS();
$deleteRolInfo = $deleteRol->EliminarRolesEmpleado($id_emp);

$delete = new EMPLEADOS();
$deleteInfo = $delete->EliminarEmpleado($id_emp);

sleep(2);

header('Location: ../empleados.php');