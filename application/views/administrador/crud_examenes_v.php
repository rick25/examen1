<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.css" media="screen" />
    <title>Administrar Examenes</title>
    

</head>
<body>
    <!--navbar fija-->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url('principal'); ?>">Examen Sagrada Familia</a>
        </div>
        <div class="navbar-collapse collapse pull-right">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo base_url('principal'); ?>">Inicio</a></li>
            <li><a href="#">Sobre</a></li>
            <li><a href="#">Contacto</a></li>
            <li>
              <a href="<?php echo base_url('login/logout_user'); ?>"><span class="glyphicon glyphicon-off"></span> Salir</a>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <!--fin navbar fija-->

    <div class="jumbotron">
      <div class="container">
        <h1>Habilitar Exámen</h1>
        <p>Desde aqui puede ver los examenes habilitados</p>
        <p>Podra además: Habilitar/Deshabilitar Exámenes por grado.</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button" href="<?php echo base_url() ?>principal/index">Volver al inicio &raquo;</a></p>-->
      </div>
    </div>
<!-- establecemos las configuraciones -->
<script type="text/javascript">
$(document).ready(function(event){
  //APLICO LA CLASE DEL BOTON DEPENDIENDO
  $(":button").addClass(function (argument) {
    //var valor = $("#botonHabilitado").html();
    var valor = $(this).attr("id-i");
    if (valor == '1') {
      return "btn btn-success";
    }else{
      return "btn btn-danger";
    }
  });
  //CAMBIO EL TEXTO DEL BOTON DEPENDIENDO
  $(":button").html(function (argument) { //anterior   $(":button").html(function (argument) 
    var valor = $(this).attr("id-i");
    if ( valor == '1') {
      return "Habilitado";
    } else{
      return "Deshabilitado";
    };
  });
  //SI HAGO CLICK EN EL BOTON CAMBIO EL ESTADO DEL EXAMEN
  $(":button").click(function (argument) { // anterior   $(":button").click(function (argument) {
    var valor = $(this).attr("id-i");
    var id    = $(this).attr("id");
    if (valor == '1') {
      console.log('cambio a Deshabilitado');
      valor = '0';
    } else{
      console.log('cambio a Habilitado');
      valor = '1';
    };
    var Datos = {
      id    : id,
      valor : valor
    };
    console.log(Datos);

    var postUrl = '/Examen1/administrador/crud_examenes_controller/cambiarEstado';

    $.ajax({
      type:'POST',
      url      : postUrl,
      dataType : 'text',
      data     : Datos,

      success : function (argument) {
        alert('Cambiando Estado...');
        setTimeout(function() {
          window.location.href = "<?php echo base_url() ?>administrador/crud_examenes_controller";
          },1000
        );
      }
    });
  });
  
});


</script>
<div class="row">
  <div class="container">
    <table id="flex1" style="font-size:18px;" class="table table-hover">
      <!--<?php var_dump($datos_examenes); ?>-->
      <tbody>
        <!--<td>ID</td>-->
        <td>Grado</td>
        <td>Cantidad de Preguntas</td>
        <td>Habilitado</td>
      </tbody>
      <?php if( empty($datos_examenes) ) : ?>
        <h2>No hay examenes Cargagos</h2>
      <?php else: ?>
        <?php foreach ($datos_examenes as $key => $value) : ?>
          <tr>
            <!--<td><?php echo $value['id_examen']; ?></td>-->
            <td><?php echo $value['nombre']; ?></td>
            <td><?php echo $value['cantidad_preguntas']; ?></td>
            <td><button type="button" id-i="<?php echo $value['habilitado']; ?>" id="<?php echo $value['id_examen']; ?>"><?php echo $value['habilitado']; ?></button></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </table>
    
    <div class="row">
      <!--PARA AGREGAR UN EXAMEN-->
      <!--
      <button type="button" class="btn btn-success btn-lg">Agregar Examen</button>
      -->
      <!--PARA AGREGAR UN EXAMEN-->
    </div>
  



</div>
</div>
</body>
</html>
