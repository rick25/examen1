<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $titulo ?></title>

    <!-- Bootstrap CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/font-awesome.css'); ?>" rel="stylesheet">
    
    <!-- Estilo propio -->
    <link href="<?php echo base_url('assets/css/estilo_admin_main.css'); ?>" rel="stylesheet">
    
    <style type="text/css">
      .dibu{
        margin-left: 200px;
      }
      .imagen{

      }
    </style>
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
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Administrar <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li class="dropdown-header">Alumnos</li>
                <li><a href="<?php echo base_url('administrador/administrar_evaluaciones'); ?>"><span class="glyphicon glyphicon-tasks"></span> Ver Notas</a></li>
                <li><a href="<?php echo base_url('administrador/crud_alumnos_controller'); ?>"><span class="glyphicon glyphicon-user"></span> Gestion de Alumnos</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Examenes</li>
                <li><a href="<?php echo base_url('administrador/crud_examenes_controller'); ?>"><span class="glyphicon glyphicon-folder-open"></span> Habilitar Examen</a></li>
                <li><a href="<?php echo base_url('administrador/prueba2_controller/elige'); ?>"><span class="glyphicon glyphicon-tasks"></span> Preparar Examen</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Sistema</li>
                <li><a href="<?php echo base_url('login/logout_user'); ?>"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <!--fin navbar fija-->
    <div class="container">

      <div class="jumbotron">
        <h1>Bienvenido Administrador!</h1>
        <p>Desde aqui podra ver estadisticas de las notas. Para mas opciones dirijase al boton <span class="glyphicon glyphicon-cog imagen"></span>  Administrar en la 
        parte superior derecha.</p>
      </div>
      <!--AQUI EMPIEZAN LAS ESTADISTICAS-->
      <div class="row">
        <div class="col-sm-2">
          <ul class="tabbable nav nav-pills nav-stacked">
            <li class="nav-header">
              <div class="page-header">
                <h3>Estadisticas</h3>
              </div>
            </li>
            <!--recorro los grados-->
            <?php foreach ( $grados as $grado ): ?>
            <!--recorro los secciones-->
            <?php foreach ( $secciones as $key => $seccion ): ?>
              <?php if ( $grado['id_grado'] == $key && !is_array( $seccion ) ): ?>
            <li class=""><a href="#<?php echo $grado['id_grado']; ?>" data-toggle="tab" class="enlace"><?php echo $grado['nombre']; ?></a></li><!---->
              <?php elseif( $grado['id_grado'] == $key ) : ?>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $grado['nombre']; ?></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
              <?php foreach ($seccion as $valor): ?>
                <li><a href="#<?php echo $grado['id_grado'].$valor; ?>" data-toggle="tab" class="enlace"><?php echo $grado['nombre'].' '.$valor; ?> </a></li>
              <?php endforeach ?>
              </ul>
            </li>
              <?php endif; ?>
            <?php endforeach ?>
            <!--fin recorro los secciones-->
            <?php endforeach ?>
            <!--fin recorro los grados-->
          </ul>
        </div><!-- /.col-sm-2 -->
        <div class="col-sm-10 tab-content">
          <!--recorro los grados-->
          <?php foreach ( $grados as $key => $grado ): ?>
          <!--recorro las secciones-->
          <?php foreach ( $secciones as $key => $seccion ): ?>
            <?php if ( $grado['id_grado'] == $key && !is_array( $seccion ) ): ?>
          <div class="tab-pane" id="<?php echo $grado['id_grado']; ?>">
            <!-- /.panel -->
              <div class="panel panel-success">
                <div class="panel-heading">
                  <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $grado['nombre']; ?>
                  <span class="badge pull-right"><strong>Entregados :</strong><?php echo $total_alumnas_entregado[ $grado['id_grado'] ]; ?></span>
                  <span class="badge pull-right"><strong>Total :</strong><?php echo $total_alumnas[ $grado['id_grado'] ]; ?> alumnas</span>
                </div>
                <div class="panel-body">
                  <div class="dibu" id="dibujo<?php echo $grado['id_grado']; ?>" style=" width: 500px; height: 300px;"></div>
                  <!--<a href="#" class="btn btn-default btn-block">View Details</a>-->
                </div>
              <!-- /.panel-body -->
              </div>
            <!-- /.panel -->
          </div>
          <?php elseif( $grado['id_grado'] == $key ) : ?>
            <!--recorro las opciones de las secciones-->
            <?php foreach ($seccion as $valor): ?>
          <div class="tab-pane" id="<?php echo $grado['id_grado'].$valor; ?>">
            <!-- /.panel -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $grado['nombre'].' '.$valor ?>
                  <span class="badge pull-right"><strong>Entregados :</strong><?php echo $total_alumnas_entregado[ $grado['id_grado'] ][ $valor ]; ?></span>
                  <span class="badge pull-right"><strong>Total :</strong><?php echo $total_alumnas[ $grado['id_grado'] ][ $valor ]; ?> alumnas</span>
                </div>
                <div class="panel-body">
                  <div class="dibu" id="dibujo<?php echo $grado['id_grado'].$valor; ?>" style="width: 500px; height: 300px;"></div>
                  <!--<a href="#" class="btn btn-default btn-block">View Details</a>-->
                </div>
              <!-- /.panel-body -->
              </div>
            <!-- /.panel -->
          </div>
            <?php endforeach; ?>
            <!--fin recorro las opciones de las secciones-->
          <?php endif ?>
          <?php endforeach ?>
          <!--fin recorro los secciones-->
          <?php endforeach ?>
          <!--fin recorro los grados-->
        </div><!-- /.col-sm-10 -->
      </div>

      <!--FIN AQUI EMPIEZAN LAS ESTADISTICAS-->

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
    <script src="<?php echo base_url('assets/js/jquery11.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>

    <script src="<?php echo base_url('assets/js/morris/plugins/raphael-2.1.0.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/morris/plugins/morris.js'); ?>"></script>

    <script type="text/javascript">
      $(document).ready(function (argument) {
        $(".enlace").click(function (e) {
          e.preventDefault();
          var a = $( this ).attr('href');
          var b = a.substring(1,2);
          var c = a.substring(2,3);
          mostrar( b, c );
        });
/*
        $("li > a").click(function (argument) {
          var a = $( this ).attr('href');
          var b = a.substring(1,2);
          var c = a.substring(2,3);
          //console.log(c);

          var Url = '/Examen1/principal/obtenerDatos';
          var Datos = {
            grado : b,
            seccion : c
          };
          $.ajax({
              url: Url,
              type: "post",
              dataType:"json",
              data: Datos,
              success : function (resp){
                  //alert(resp);
                  Morris.Donut({
                      element: 'dibujo'+b+c,
                      data: resp,
                      resize: true,
                      backgroundColor: '#ccc',
                      labelColor: '#06B',
                      colors: [
                        '#334D5C',
                        '#E27A3F',
                        '#EFC94C',
                        '#DF4949',
                        '#45B29D',
                        '#4093BF'
                      ],
                      formatter: function (x) { return x + " alumnos"}
                  });
              },
              error: function(jqXHR, textStatus, ex) {
                console.log(textStatus + "," + ex + "," + jqXHR.responseText);
              }
          });
        });
*/         
      });
      function mostrar ( b,c ) {
        var Url = '/Examen1/principal/obtenerDatos';
        if ( c == "" ) {
          var Datos = {
            grado : b
         };
        } else{
          var Datos = {
            grado : b,
            seccion : c
         };     
        };
          $.ajax({
              url: Url,
              type: "post",
              dataType:"json",
              data: Datos,
              success : function (resp){
                  //alert(resp);
                  Morris.Donut({
                      element: 'dibujo'+b+c,
                      data: resp,
                      resize: true,
                      backgroundColor: '#ccc',
                      labelColor: '#06B',
                      colors: [
                        '#334D5C',
                        '#E27A3F',
                        '#EFC94C',
                        '#DF4949',
                        '#45B29D',
                        '#4093BF'
                      ],
                      formatter: function (x) { return x + " alumnos"}
                  });
              },
              error: function(jqXHR, textStatus, ex) {
                console.log(textStatus + "," + ex + "," + jqXHR.responseText);
              }
          });
      }
    </script>
  </body>
</html>
