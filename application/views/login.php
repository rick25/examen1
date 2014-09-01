<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login Examen</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
  <style>
    body {
      /*background-color: #0088cc;*/
      padding-top: 60px;
      padding-bottom: 40px;
    }
    #header {  
      background: #002134;
    }

    #header h1 {
      padding: 15px 30px;
      font-size: 32px;
    }
    #header h1{
      color: #fff;
    }
    #container {
      min-width: 960px;
    }
  </style>
  <!--<link rel="stylesheet" href="<?php /*echo base_url();*/?>/assets/css/bootstrap-responsive.min.css">-->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">

  <script src="<?php echo base_url();?>assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  
</head>
<body>

  <div id="container">
    <div id="header">
      <h1>Examen en linea</h1>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="row">
      <div class="span4 offset8 well">

        <legend>Por favor Inicie Sesion</legend>

        <?php if (isset($error) && $error): ?>
          <div class="alert alert-error">
            <a class="close" data-dismiss="alert" href="#">×</a>Numero de DNI o Contraseña incorrectos !!
          </div>
          <div class="alert alert-error">
            <a class="close" data-dismiss="alert" href="#">×</a><?php echo validation_errors(); ?>
          </div>
        <?php endif; ?>

        <?php echo form_open('login/login_user') ?>
        <label for="dni">DNI</label>
        <input type="text" id="dni" class="span4" name="dni" placeholder="Numero DNI">
        <label for="password">Contraseña</label>
        <input type="password" id="password" class="span4" name="password" placeholder="Contraseña">

        <button type="submit" name="submit" class="btn btn-info btn-block">Iniciar Sesion</button>
        
        </form>
      </div>
    </div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo base_url();?>/js/vendor/jquery-1.9.0.min.js"><\/script>')</script>

<script src="<?php echo base_url();?>/assets/js/vendor/bootstrap.min.js"></script>

</body>
</html>