<?php $this->load->view('header') ?>

  <div class="navbar">
    <div class="navbar-inner">
      <div class="container-fluid">
        <a class="brand" href="#" name="top">Aplicacion Examen</a>
          <ul class="nav">
            <li><a href="#"><i class="icon-home"></i> Examen General</a></li>
            <li class="divider-vertical"></li>
          </ul>
          <div class="btn-group pull-right">
            <?php if (!$is_admin) : ?>
              <a class="btn" href="<?php echo base_url() ?>login/logout_user"><i class="icon-share"></i> Salir</a>
            <?php endif; ?>
          </div>
      </div><!--/.container-fluid -->
    </div><!--/.navbar-inner -->
  </div><!--/.navbar -->

  <div class="container">

    <!-- Left Column -->
    <div class="span3">

      <!-- User Info -->
      <div class="row well userInfo">
        <div class="span1">
          <!--<img src="../assets/img/avatars/<?php echo $avatar ?>.png" alt="Administrador">-->
          <img src="<?php echo base_url(); ?>assets/img/avatars/<?php echo $avatar ?>.png" alt="Administrador">
        </div>
        <div class="span2 userInfoSpan2">
          <p><strong> <?php echo $nombre ?> </strong></p>
        </div>
        <div class="span2 userInfoSpan2">
          <p id="pTagline" contenteditable="true"><?php echo $mensaje ?></p>
        </div>
        <div class="userTeamBadge">
          <?php if(!$is_admin) :?><span class="badge badge-info">Alumno</span><?php endif ?>
        </div>
      </div>


      <!-- Message Box -->
      <div class="row well">
        <!--<a id="btnPost" class="btn btn-info" href="<?php echo base_url() ?>usuarios">Iniciar Examen</a>-->
        <!--<a id="btnPost" class="btn btn-info" href="<?php echo base_url() ?>email_controller">Enviar mail prueba</a>-->
        <a id="btnPost" class="btn btn-info" href="<?php echo base_url() ?>usuario/examen_controller">Realizar</a>
      </div>
    </div>
    <!-- End Left Column -->

    <!-- Right Column -->
    <div class="span7 offset1">
      <div class="row">
        <h2>Examen de Religion</h2>
        <p>Por favor tenga en cuenta las indicaciones del docente.</p>
        <p>Cuando el docente lo indique podra iniciar el examen.</p>
      </div><!-- row -->
    </div>
    <!-- End Right Column -->
    
  </div>

<!--<?php $this->load->view('footer'); ?>-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo base_url();?>/js/vendor/jquery-1.9.0.min.js"><\/script>')</script>

<script src="<?php echo base_url();?>/assets/js/vendor/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>/assets/js/main.js"></script>
</body>
</html>