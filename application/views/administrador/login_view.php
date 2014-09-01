<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">

	<title>Login Administrador</title>

	<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
	<style type="text/css">
		label{
			display: block;
		}
		.error{
			color: #373737;
			font-style: italic;
		}
		#formulario_anotaciones{
			background: #e3e3e3;
			width: 40%;
			margin: 5em auto 0;
			padding: 32px;
			border: 1px solid #d5d5d5;
		}
		#formulario_anotaciones form input[type=text]{
			width: 100%;
		}
		h2{
			margin-top: -54px;
			color: #aa2828;
			font-family: arial;
		}
		input[type=submit]{
			border: 1px solid #c62828;
			background: #aa2828;
			color: #e3e3e3;
			padding: .5em;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div class="container">
		<div id="formulario_anotaciones">
			<h2>Login de Administrador</h2>
			<?php echo form_open( 'administrador/login_admin/login' ); ?>
				<?php
				$dni_data = array(
					'name' => 'dni', 
					'id' => 'dni', 
					'value' => set_value('dni')
					);
				?>
				<p><label for="dni">DNI: </label><?php echo form_input( $dni_data ); ?></p>
				<p>
					<label for="password">Contraseña: </label>
					<input type="password" id="password" class="span4" name="password" placeholder="Contraseña">
				</p>
				<p><?php echo form_submit('submit', 'Enviar'); ?></p>
			<?php echo form_close(); ?>
			<?php echo validation_errors('<p class="error">'); ?>
		</div><!--FIN formulario_anotaciones-->
	</div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/1.3.1/lodash.min.js"></script> -->
	<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
	<!--
	<script src="<?php echo base_url('assets/js/tooltip.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/popover.js') ?>"></script>
	-->
	<script type="text/javascript">
	$(function (argument) {

	});
	</script>
</body>
</html>