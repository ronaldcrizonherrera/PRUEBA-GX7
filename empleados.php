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



<link rel="stylesheet" href="util/sweetalert/sweetalert.css">
<script src="util/sweetalert/sweetalert.js"></script>

</head>
<body>
<!-- Menu -->
<?php include 'menu.php'; ?>
<!-- Menu Fin -->
<br/><br/>
<center>

<?php

if (isset($_GET['msg'])) {
$nombre = $_GET['msg'];
$mensaje = "<div class='alert alert-success' role='alert'>
          Producto: <b>".$nombre."</b> Fue Eliminado!</div>";
echo $mensaje;
}

?>

<form id="formForm" name="formForm" method="post" action="ctr/nuevo.ctr.php">
<table style="width: 90%" class="table table-bordered">
  <tr><td><h4>Empleados</h4></td></tr>
  <tr>
    <td>


      <form id="makedinputs" action="#" method="post">
        <input type="text" id="product" name="product" 
        placeholder="Buscar: Digita el nombre o email del empleado"
        class="form-control">
      </form>

      <br/>
      <div class="content" id="datos"></div>

      






    </td>
  </tr>
</table>
</center>
</form>
<br/>
<center>
<div id="respuesta"></div>
</center>
</body>
<script type="text/javascript">
$(buscar_datos());

function buscar_datos(consulta){
  $.ajax({
    url: 'phpAjax/buscar.ajax.vw.php' ,
    type: 'POST' ,
    dataType: 'html',
    data: {consulta: consulta},
  })
  .done(function(respuesta){
    $("#datos").html(respuesta);
  })
  .fail(function(){
    console.log("error");
  });
}


$(document).on('keyup','#product', function(){
  var valor = $(this).val();
  if (valor != "") {
    buscar_datos(valor);
  }else{
    buscar_datos();
  }
});


</script>
</html>