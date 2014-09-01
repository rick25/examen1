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
        <p><a class="btn btn-primary btn-lg" id="volver" role="button" href="<?php echo base_url(); ?>administrador/crud_alumnos_controller">Volver &laquo;</a></p>
      </div>
    </div>
	<div class="row">
		<div class="container">
			<?php if( $accion == 'Agregar nuevo registro..' ): ?>
			<form action="" method="POST" class="form" role="form">
					<div class="form-group">
						<legend>Form title</legend>
					</div>
					

					<div class="col-xs-2">
					    <label for="dni">DNI</label>
					    <input type="text" class="form-control" id="dni" placeholder="Ingrese DNI" required>
					</div>
					<div class="col-xs-3">
					    <label for="password">Contraseña</label>
					    <input type="password" class="form-control" id="password" placeholder="Contraseña" disabled="true">
					</div>
					<div class="col-xs-2">
						<label for="sexo">Sexo</label>
					    <select name="sexo" id="sexo" class="form-control" required>
					    	<option value="">Elija</option>
					    	<option value="F">Femenino</option>
					    	<option value="M">Masculino</option>
					    </select>
					</div>
					<div class="col-xs-2">
					    <label for="grado">Grado</label>
					    <select name="grado" id="grado" class="form-control" required>
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
						<label for="seccion">Seccion</label>
					    <select name="seccion" id="seccion" class="form-control" required>
					    	<option value="">Elija</option>
					    	<option value="A">A</option>
					    	<option value="B">B</option>
					    	<option value="C">C</option>
					    </select>
					</div>
					<div class="clearfix"></div>
					<br>
					<div class="col-xs-6">
						<label for="nombre">Ingrese Nombre</label>
					    <input type="text" class="form-control" id="nombre" placeholder="Ingrese Nombre" required>
					</div>
					<div class="clearfix"></div>
					<br>
					<div class="col-xs-6">
						<label for="apellido1">Apellido Paterno</label>
					    <input type="text" class="form-control" id="apellido1" placeholder="Ingrese Apellido Paterno" required>
					</div>
					<div class="clearfix"></div>
					<br>
					<div class="col-xs-6">
						<label for="apellido2">Apellido Materno</label>
					    <input type="text" class="form-control" id="apellido2" placeholder="Ingrese Apellido Materno" required>
					</div>
					<br>
					<div class="clearfix"></div>
					<hr>
					<div id="err_dni"></div>
					<div id="err_nombre"></div>
					<div id="err_password"></div>
					<div id="err_apellido1"></div>
					<div id="err_apellido2"></div>
					<div id="err_sexo"></div>
					<div id="err_grado"></div>
					<div id="err_seccion"></div>		
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<button type="submit" class="btn btn-success" id="agregar_alumno">Agregar</button>
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
			$("#nombre").keyup(function () {
		        var value = $(this).val();
		        value = value.toLowerCase();
		        $("#password").val(value);
		    });
			$("#agregar_alumno").on('click', function (event)   //cuando hago click en el boton de añadir alumno
            {
            	event.preventDefault();
                //TOMO LOS DATOS DEL MODAL Y LOS ENVIO POR AJAX
                var formData = {
                    dni        : $('#dni').val(),
                    nombre     : $('#nombre').val(),
                    password   : $('#password').val(),
                    apellido1  : $('#apellido1').val(),
                    apellido2  : $('#apellido2').val(),
                    sexo       : $('#sexo').val(),
                    grado      : $('#grado').val(),
                    seccion    : $('#seccion').val()        
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
                            $("#err_dni").html(obj.dni);
                            $("#err_nombre").html(obj.nombre);
                            $("#err_password").html(obj.password);
                            $("#err_apellido1").html(obj.apellido1);
                            $("#err_apellido2").html(obj.apellido2);
                            $("#err_sexo").html(obj.sexo);
                            $("#err_grado").html(obj.grado);
                            $("#err_seccion").html(obj.seccion);
                            return false;
                        }else{
                        	alert('El usuario fué añadido correctamente');
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
            });//FIN DE AGREGAR_USUARIO
		});
	</script>
</body>
</html>