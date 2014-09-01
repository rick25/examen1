<?php $this->load->view('header') ?>

  <div class="navbar">
    <div class="navbar-inner">
      <div class="container-fluid">
        <a class="brand" href="#" name="top">Aplicacion para Administrador</a>
          <ul class="nav">
            <li><a href="#"><i class="icon-home"></i> Home Administrador</a></li>
            <li class="divider-vertical"></li>
          </ul>
          <div class="btn-group pull-right">
            <?php if ($is_admin) : ?>
              <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="icon-wrench"></i> administrar	<span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <!--<li><a href="<?php echo base_url() ?>crud/"><i class="icon-share"></i> Crud Usuarios</a></li>-->
                <li><a href="<?php echo base_url(); ?>administrador/crud_alumnos_controller/"><i class="icon-user"></i> Gestion de Alumnos</a></li>
                <li><a href="<?php echo base_url(); ?>administrador/crud_examenes_controller/"><i class="icon-folder-open"></i> Habilitar Examen</a></li>
                <li><a href="<?php echo base_url(); ?>administrador/prueba2_controller/elige"><i class="icon-tasks"></i> Preparar Examen</a></li>
                <li><a href="<?php echo base_url(); ?>administrador/administrar_evaluaciones"><i class="icon-pencil"></i> Ver Notas</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>login/logout_user"><i class="icon-share"></i> Salir</a></li>
              </ul>
            <?php endif; ?>
          </div>
      </div>
      <!--/.container-fluid -->
    </div>
    <!--/.navbar-inner -->
  </div>
  <!--/.navbar -->

  <div class="container">

    <!-- Left Column -->
    <div class="span3">
      <div class="row well userInfo">     <!-- Informacion de Usuario -->
        <div class="span1">
          <img src="../assets/img/avatars/<?php echo $avatar ?>.png" alt="Administrador">
        </div>
        <div class="span2 userInfoSpan2">
          <p><strong> <?php echo $nombre ?> </strong></p>
        </div>
        <div class="span2 userInfoSpan2">
          <p id="pTagline" contenteditable="true"><?php echo $mensaje ?></p>
        </div>
        <div class="userTeamBadge">
          <?php if($is_admin) :?><span class="badge badge-info">Administrador</span><?php endif ?>
        </div>
      </div>                            <!-- Fin Informacion de Usuario -->
    </div> <!-- End Left Column -->

      <!-- Right Column -->
    <div class="span7 offset1">
      <div class="row">
          <div class="header">
            <h1 class="header">Sistema de Gestion de Examenes</h4>
            <p class="lead">Aqui se mostraran las notificaciones del sistema.</p>

            <!--PANEL PARA PAGINACION USUARIOS
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Paginacion de Usuarios</h3>
              </div>
              <div class="panel-body">
                  Muestra los usuarios de la base de datos examen1 utilizando la libreria pagination.
                  Ver:
                  <ul>
                    <li>ver_usuarios_controller</li>
                    <li>ver_usuarios_model</li>
                    <li>ver_usuarios_view</li>
                  </ul>
                  <a href="<?php echo base_url('ver_usuarios_controller') ?>">Ver</a>
              </div>
              <div class="panel-footer">
                Panel footer
              </div>
            </div>
            -->
            <h4><strong>Para empezar clickear en Administrar. En la esquina superior derecha.</strong></h4>
            


          </div>
      </div><!-- row -->
    </div><!-- End Right Column -->

  </div>
  </div>

<?php $this->load->view('footer') ?>