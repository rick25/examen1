<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title><?php echo $titulo; ?></title>
  <!-- Bootstrap CSS -->
  <link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <script src="<?php echo base_url('assets/js/jquery11.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
  

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
  
  <!--INICIO CONTAINER-->
  <div class="container">
    <div class="jumbotron">
      <h2><?php echo $titulo; ?>!</h2>
      <p>Elija un grado para preparar el examen</p> <p>Luego haga click en siguiente</p>
    </div>
    
    <div class="row">
      <div class="col-md-4 col-md-offset-4 well">
        <?php if (isset($error) && $error): ?>
          <div class="alert alert-error">
            <a class="close" data-dismiss="alert" href="#">×</a>Debe elegir un grado para continuar !!
          </div>
        <?php endif; ?>

        <?php echo form_error('grado', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>', '</div>'); ?>
        <?php echo form_open('administrador/prueba2_controller/direccionar') ?>
          <select class="form-control" name="grado" id="grado">
              <option value="">Elija Grado</option>
            <?php foreach ($grados as $key => $grado) : ?>
              <option value="<?php echo $grado['id_grado']; ?>"><?php echo $grado['nombre']; ?></option>
            <?php endforeach; ?>
          </select>
          <br>
          <button type="submit" name="submit" class="btn btn-info btn-large">Siguiente</button>
        </form>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <p>&copy; Powered by Ricardo || 2015</p>
      </div>
    </div>
  </div>
  <!--FIN CONTAINER-->
  
</body>
</html>