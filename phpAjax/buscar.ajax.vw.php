<?php
include '../files/class_empleados.php';

$empleados = new EMPLEADOS();
if (isset($_POST['consulta'])) {
   $consulta = $_POST['consulta'];
   $empleadosInfo = $empleados->getEmpleadoFiltro($consulta);
}else{
   $empleadosInfo  = $empleados->getEmpleados();
}

?>

<script type="text/javascript">
function eliminarEmpleado(id) {
    swal({ 
    title: "CONFIRME PARA ELIMINAR",
    text:  "Esto puede que traiga consecuencias para quienes tienen este registro asociado.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "¡Confirmar!",
    cancelButtonText: "Cancelar", 
    closeOnConfirm: false,
    closeOnCancel: false },

    function(isConfirm){ 
        if (isConfirm) {

            swal("¡Hecho!",
            "Has eliminado el Empleado",
            "success");
            document.location = "ctr/eliminar.ctr.php?id="+id;
            
        } else { 

            swal("¡Has Cancelado la accion!", 
            "El registro seguira activo", 
            "error"); 

        } 
    });

}
</script>
<table class="table">
        <tr>
          <th align="center">#</th>
          <th align="left">Nombre</th>
          <th align="left">Email</th>
          <th align="center">Sexo</th>
          <th align="center">Area</th>
          <th align="center">Boletin</th>
          <th align="center">Modificar</th>
          <th align="center">Eliminar</th>
        </tr>

        <?php
        $cont=0;
        for ($i=0; $i < sizeof($empleadosInfo); $i++) { 
        $cont++;
        $id = $empleadosInfo[$i]['id'];
        $nombre = $empleadosInfo[$i]['nombre'];
        $email = $empleadosInfo[$i]['email'];
        $sexo = $empleadosInfo[$i]['sexo'];
        $area_id = $empleadosInfo[$i]['area_id'];
        $boletin = $empleadosInfo[$i]['boletin'];
        $descripcion = $empleadosInfo[$i]['descripcion'];

        $area_emp = new EMPLEADOS();
        $area_empInfo  = $area_emp->getAreaEmpleado($area_id);
        $area_nombre = $area_empInfo[0]['nombre'];

        if ($boletin == 1 || $boletin == '1') {
          $boletin_text = 'SI';
        }elseif ($boletin == 0 || $boletin == '0') {
          $boletin_text = 'NO';
        }else{
          $boletin_text = 'Err';
        }

        ?>

        <tr>
          <td><?php echo $cont; ?></td>
          <td><?php echo $nombre; ?></td>
          <td><?php echo $email; ?></td>
          <td><?php echo $sexo; ?></td>
          <td><?php echo $area_nombre; ?></td>
          <td><?php echo $boletin_text; ?></td>
          <td>
            <center>
            <a href="editar.php?e=<?php echo $id; ?>" type="button" class="btn btn-sm btn-info btn-flat">Actualizar</a>
            </center>
          </td>
          <td>

            <center>
              <button 
                  type="button" class="btn btn-sm btn-danger btn-flat"
                  onclick="eliminarEmpleado(<?php echo $id;?>)"
                  > ELIMINAR
              </button>
            </center>
          </td>
        </tr>

        <?php } ?>

      </table>