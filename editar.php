<?php
include 'files/class_empleados.php';
$emp_id = $_GET['e'];

$empleado = new EMPLEADOS();
$empleadoInfo = $empleado->getEmpleado($emp_id);
$id_emp = $empleadoInfo[0]['id'];
$nombre_emp = $empleadoInfo[0]['nombre'];
$email_emp = $empleadoInfo[0]['email'];
$sexo_emp = $empleadoInfo[0]['sexo'];
$area_id_emp = $empleadoInfo[0]['area_id'];
$boletin_emp = $empleadoInfo[0]['boletin'];
$descripcion_emp = $empleadoInfo[0]['descripcion'];

$area_emp = new EMPLEADOS();
$area_empInfo = $area_emp->getAreaEmpleado($area_id_emp);
$area_nombre = $area_empInfo[0]['nombre'];

//--------------------------------------------------------
//sexo
if ($sexo_emp == 'M') {
    $chekS_M = 'checked=""';
    $chekS_F = '';
}elseif ($sexo_emp == 'F') {
    $chekS_F = 'checked=""';
    $chekS_M = '';
}else{
    $chekS_F = '';
    $chekS_M = '';
}

//boletin
if ($boletin_emp == 1) {
    $chek_bol = 'checked=""';
}elseif ($sexo_emp == 0) {
    $chek_bol = '';
}else{
    $chek_bol = '';
}


//--------------------------------------------------------

$areas_emp = new EMPLEADOS();
$areas_empInfo = $areas_emp->getAreasEmpleados();

$roles_emp = new EMPLEADOS();
$roles_empInfo = $roles_emp->getRoles();

?>
<!DOCTYPE html>
<html>
<head>
	 <title>GX7 - Test</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<!-- VALIDATE -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA==" crossorigin="anonymous"></script>

</head>
<body>
<!-- Menu -->
<?php include 'menu.php'; ?>
<!-- Menu Fin -->

<center>


<br/>
<center>
<div id="respuesta"></div>
</center>
<br/>

<form id="formForm" name="formForm" method="post" action="ctr/actualizar.ctr.php">
<input type="hidden" name="id_empleado" id="id_empleado" value="<?php echo $emp_id; ?>">

<table style="width: 90%" class="table table-bordered">
  <tr><td><h4>Editar Empleado</h4></td></tr>
  <tr>
    <td>

      <div class='alert alert-info' role='alert'>
        Los Campos con asterisco (*) son obligatorios!
      </div>





<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label><b>Nombre Completo del Empleado *</b></label>
      <input type="text" class="form-control" name="nombre" id="nombre" 
      value="<?php echo $nombre_emp; ?>">
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label><b>Correo Electronico *</b></label>
      <input type="text" class="form-control" 
      name="email" id="email"value="<?php echo $email_emp; ?>">
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <label><b>Sexo *</b></label>
    <div class="form-group">
    <div class="form-check">
    <input class="form-check-input" type="radio" name="sexo" id="sexo1" value="M" 
    <?php echo $chekS_M; ?> >
    <label class="form-check-label">MASCULINO</label>
    </div>
    <div class="form-check">
    <input class="form-check-input" type="radio" name="sexo" id="sexo2" value="F" 
    <?php echo $chekS_F; ?> >
    <label class="form-check-label">FEMENINO</label>
    </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label><b>Area *</b></label>
      <select class="form-control" name="area" id="area">
        <option value="<?php echo $area_id_emp; ?>"><?php echo $area_nombre; ?></option>
        <?php
        foreach ($areas_empInfo as $key => $value) {
        $id_area = $value['id'];
        $nombre_area = $value['nombre'];
        ?>
        <option value="<?php echo $id_area; ?>"><?php echo $nombre_area; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label><b>Descripcion *</b></label>
      <textarea class="form-control" name="descripcion" id="descripcion"><?php echo $descripcion_emp; ?></textarea>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="boletin" id="boletin" value="S" 
      <?php echo $chek_bol; ?> >
      <label class="form-check-label"><b>Deseo recibir boletin informativo!</b></label>
    </div>
    </div>
  </div>
</div>

<br/>

<div class="row">
  <div class="col-sm-12">
    <div class="form-group">
    <label><b>Roles *</b></label>
    <div class="form-check">

      <?php
        foreach ($roles_empInfo as $key => $value) {
        $id_rol = $value['id'];
        $nombre_rol = $value['nombre'];

        $roles_emp = new EMPLEADOS();
        $roles_empInfo = $roles_emp->get_Rol_Empleado($id_emp, $id_rol);
        $filas = sizeof($roles_empInfo);
        if ($filas > 0) {
            $check_rol = 'checked = ""';
        }else{
            $check_rol = '';
        }


        ?>
         <input class="form-check-input" type="checkbox" name="rol[]"
         id="rol<?php echo $id_rol; ?>" value="<?php echo $id_rol; ?>" 
         <?php echo $check_rol; ?> >
         <label class="form-check-label"><?php echo $nombre_rol; ?></label>
         <br/>
        <?php
        }
        ?>
     


    </div>
    </div>
  </div>
</div>

<br/>


  <div class="col-sm-12">
      <center><button type="submit" class="btn btn-primary">Editar</button></center>
  </div>

</div>

        

    </td>
  </tr>

</table>
</center>
</form>

</body>
<script type="text/javascript">
$(function () {

$.validator.setDefaults({
    submitHandler: function () {
      //alert( "Form successful submitted!" );
      //alert("submitted!");
      //ACCEDEMOS AL ACTION DEL FORMULARIO
      $.post($("#formForm").attr("action"),
          $("#formForm :input").serializeArray(),
              function(data){
                  $("div#respuesta").html(data);
              });
      //LIMPIAMOS EL FORMULARIO
      //$("#rowTodo").load(" #rowTodo"); //Recarga solo el div con id #rowTodo
      $("#formForm")[0].reset();
    }
});

/*
$.validator.addMethod("rol", function(value, elem, param) { if($(".rol:checkbox:checked").length > 0){ return true; }else { return false; } },"Seleccione al menos un rol!");

*/

$('#formForm').validate({
    rules: {
      nombre: {
        required: true
      },
      email: {
        required: true, 
        email: true 
      },
      sexo: {
        required: true
      },
      descripcion: {
        required: true
      },
      "rol[]": {
        required: true, 
        minlength: 1 
      }
    },
    messages: {
      nombre: {
        required: "Campo requerido!"
      },
      email: {
        required: "Campo requerido!", 
        email: "Email invalido!" 
      },
      sexo: {
        required: "Campo requerido!"
      },
      descripcion: {
        required: "Campo requerido!"
      },
      "rol[]": {
        required: "Marque almenos una opcion!"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
});


});

</script>
</html>