<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $titulo ?></title>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.css" media="screen" />
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar">Primer</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Examen Sagrada Familia</a>
            </div>
            <div class="navbar-form navbar-right">
                <a class="btn btn-danger" role="button" href="<?php echo base_url() ?>login/logout_user"></i> Salir del sistema</a>
            </div><!--/.navbar-collapse-->
        </div>
    </div><!--FIN DE NAVBAR INVERSE-->

    <div class="jumbotron">
      <div class="container">
        <h1><?php echo $accion; ?></h1>
        <p></p>
        <p><a class="btn btn-primary btn-lg" id="volver" role="button" href="<?php echo base_url() ?>administrador/crud_alumnos_controller">Volver &laquo;</a></p>
      </div>
    </div>
	<div class="row">
		<div class="container">
			<?php if( isset($usuario) && $usuario ) : ?>
				<form action="" method="POST" class="form" role="form">
					<div class="form-group">
						<legend>Form title</legend>
					</div>
					

					<div class="col-xs-2">
					    <label for="dni_m">DNI</label>
					    <input type="text" class="form-control" id="dni_m" placeholder="Ingrese DNI" required>
					</div>
					<div class="col-xs-3">
					    <label for="password_m">Contraseña</label>
					    <input type="password" class="form-control" id="password_m" placeholder="Contraseña" disabled="true">
					</div>
					<div class="col-xs-2">
						<label for="sexo_m">Sexo</label>
					    <select name="sexo" id="sexo_m" class="form-control" required>
					    	<option value="">Elija</option>
					    	<option value="F">Femenino</option>
					    	<option value="M">Masculino</option>
					    </select>
					</div>
					<div class="col-xs-2">
					    <label for="grado_m">Grado</label>
					    <select name="grado_m" id="grado_m" class="form-control" required>
					    	<option value="">Elija</option>
					    	<option value="1">1º Grado</option>
					    	<option value="2">2º Grado</option>
					    	<option value="3">3º Grado</option>
					    	<option value="4">4º Grado</option>
					    	<option value="5">5º Grado</option>
					    	<option value="6">6º Grado</option>
					    </select>
					</div>
					<div class="col-xs-2">
						<label for="seccion_m">Seccion</label>
						<!--
					    <select name="seccion_m" id="seccion_m" class="form-control" required>
					    	<option value="">Elija</option>
					    	<option value="A">A</option>
					    	<option value="B">B</option>
					    	<option value="C">C</option>
					    </select>
					    -->
					    <select name="seccion_m" id="seccion_m" class="form-control" required>
					    <?php foreach($secciones as $key => $seccion ): ?>
					    	<option value="<?php echo $key ?>"><?php echo $seccion['nombre'] ?></option>
					    <?php endforeach; ?>
					    </select>
					</div>
					<div class="clearfix"></div>
					<br>
					<div class="col-xs-6">
						<label for="nombre_m">Ingrese Nombre</label>
					    <input type="text" class="form-control" id="nombre_m" placeholder="Ingrese Nombre" required>
					</div>
					<div class="clearfix"></div>
					<br>
					<div class="col-xs-6">
						<label for="apellido1_m">Apellido Paterno</label>
					    <input type="text" class="form-control" id="apellido1_m" placeholder="Ingrese Apellido Paterno" required>
					</div>
					<div class="clearfix"></div>
					<br>
					<div class="col-xs-6">
						<label for="apellido2_m">Apellido Materno</label>
					    <input type="text" class="form-control" id="apellido2_m" placeholder="Ingrese Apellido Materno" required>
					</div>
					<br>
					<div class="clearfix"></div>
					<hr>
					<div id="err_dni_m"></div>
					<div id="err_nombre_m"></div>
					<div id="err_password_m"></div>
					<div id="err_apellido1_m"></div>
					<div id="err_apellido2_m"></div>
					<div id="err_sexo_m"></div>
					<div id="err_grado_m"></div>
					<div id="err_seccion_m"></div>
					
					<div><input type="hidden" id="id_m" value="<?php echo $usuario[0]['id'] ?>"></div>

					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<button type="submit" class="btn btn-warning" id="modificar_alumno">Modificar</button>
						</div>
					</div>
			</form>
			<?php endif; ?>
		</div>
	</div>	
	<!--Establecemos el javascript-->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			//funcion para copiar en minuscula la contraseña
			$("#nombre_m").keyup(function () {
		        var value = $(this).val();
		        value = value.toLowerCase();
		        $("#password_m").val(value);
		    });
			//CARGAMOS LOS DATOS DEL ALUMNO 
			$('#dni_m').val(<?php echo $usuario[0]['dni'] ?>);
			$('#password_m').val('<?php echo $usuario[0]['password'] ?>');
			$('#apellido1_m').val('<?php echo $usuario[0]['apellido1'] ?>');
			$('#nombre_m').val('<?php echo $usuario[0]['nombre'] ?>');
			$('#apellido2_m').val('<?php echo $usuario[0]['apellido2'] ?>');
			$('#sexo_m').val('<?php echo $usuario[0]['sexo'] ?>');
			$('#grado_m').val('<?php echo $usuario[0]['grado'] ?>');
			$('#seccion_m').val('<?php echo $usuario[0]['seccion'] ?>');
			$("#modificar_alumno").on('click', function (event)   //cuando hago click en el boton de añadir alumno
            {
            	event.preventDefault();
                //TOMO LOS DATOS DEL MODAL Y LOS ENVIO POR AJAX
                var formData = {
                	id         : $('#id_m').val(),
                    dni        : $('#dni_m').val(),
                    nombre     : $('#nombre_m').val(),
                    password   : $('#password_m').val(),
                    apellido1  : $('#apellido1_m').val(),
                    apellido2  : $('#apellido2_m').val(),
                    sexo       : $('#sexo_m').val(),
                    grado      : $('#grado_m').val(),
                    seccion    : $('#seccion_m').val()        
                };
                var postUrl = '/Examen1/' + 'administrador/am_alumnos_controller/multi';

                $.ajax({
                    type: 'POST',
                    url: postUrl,
                    dataType: 'text',
                    data: formData,

                    success:function (data) {
                        var obj = JSON.parse(data);
                        if(obj.respuesta == 'error')        //SI EN EL ARRAY QUE VIENE DEL CONTROLADOR LA LLAVE RESPUSESTA TIENE EL VALOR ERROR
                        {
                            $("#err_dni_m").html(obj.dni);
                            $("#err_nombre_m").html(obj.nombre);
                            $("#err_password_m").html(obj.password);
                            $("#err_apellido1_m").html(obj.apellido1);
                            $("#err_apellido2_m").html(obj.apellido2);
                            $("#err_sexo_m").html(obj.sexo);
                            $("#err_grado_m").html(obj.grado);
                            $("#err_seccion_m").html(obj.seccion);
                            return false;
                        }else{
                        	alert('El usuario fué modificado correctamente');
                        }
                    },
                    error:function (error) {
                        alert('El dni del usuario ya se encuentra registrado en la base de datos');
                        setTimeout(function() {
                            window.location.href = "<?php echo base_url() ?>crud_alumnos_controller";
                        	}, 
                        2000
                        );
                    }
                });
            });//FIN DE MODIFICAR_USUARIO
		});
	</script>
</body>
</html>