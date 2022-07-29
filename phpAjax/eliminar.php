<?php
include '../files/class_productos.php';

$id = $_GET['id'];

$infoP = new PRODUCTOS();
$infoPExe = $infoP->getProducto($id);
$nombre   = $infoPExe[0]['productos_nombre'];

$eliminarP = new PRODUCTOS();
$eliminarPExe = $eliminarP->EliminarProducto($id);


//header("Location:0, url=../productos.php?msg=".$mensaje, true);
//header("Location: ../productos.php?msg=".$mensaje);
header("refresh:0;url=../productos.php?msg=".$nombre);
