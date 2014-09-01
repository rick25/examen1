<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?php echo $titulo; ?></title>
  	<link rel="stylesheet" href="<?php echo base_url('assets/examen_usuario/jquery.custom/css/custom-theme/jquery-ui-1.10.4.custom.css'); ?>">
  	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
  	<style>
		body{
			/*background: #3F9FC9;*/
			font-family: "MuseoSans500",helvetica,arial,sans-serif;
		}
		.flash .message {
			/*background: #3468AF;*/
		  -moz-border-radius: 3px;
		  -webkit-border-radius: 3px;
		  border-radius: 10px;
		  text-align: center;
		  margin: 0 auto 15px;
		  color: white;
		  text-shadow: 0 1px 0 rgba(0, 0, 0, 0.3);
		}
		.flash .message p {
		  margin: 8px;
		}
		.flash .error, .flash .error-list {
		  border: 1px solid #993624;
		  background: #cc4831;
		}
		.flash .warning {
		  border: 1px solid #bb9004;
		  background: #f9c006;
		}
		#miPanel{
			background: #334D5C;
			padding: 30px 50px;

			-moz-border-radius-topright: 23px;
			-webkit-border-top-right-radius: 23px;
			border-top-right-radius: 23px;
			-moz-border-radius-bottomright: 23px;
			-webkit-border-bottom-right-radius: 23px;
			border-bottom-right-radius: 23px;
			-moz-border-radius-bottomleft: 23px;
			-webkit-border-bottom-left-radius: 23px;
			border-bottom-left-radius: 23px;
		}
		.pregunta{
	      font-size: 150%;
	      line-height: 120%;
	    }
	    .imagen img{
	      float: right;
	    }
	    .imagen{
	    	float: right;
	    	vertical-align: text-bottom;
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
            <li>
              <a href="<?php echo base_url('login/logout_user'); ?>"><span class="glyphicon glyphicon-off"></span> Salir</a>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <!--fin navbar fija-->

	<!--INICIO CONTAINER-->
	<div class="container">
		<br>
		<br>
		<br>
		<div class="alert alert-info alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		  <strong><h2>Examen de <?php echo $grado; ?>º Grado</h2></strong> <p>Ingrese las preguntas, las respuestas. Indique la respuesta correcta. Adicionalmente puede subir una imagen para mostrar.</p>
		</div>

		<!--SI EL EXAMEN ESTA HABILITADO-->
		<?php $contar = 0; ?>
		<?php if ($habilitado): ?>
			<!--SI HAY PREGUNTAS DEFINIDAS PARA EL EXAMEN-->
			<?php if( isset($preguntas) && $preguntas ) : ?>
				<!--INICIO PESTAÑAS-->
				<div id="tabs">
					<ul>
						<?php foreach ($preguntas as $key => $pregunta): ?>
							<li><a href="#pregunta<?php echo $key; ?>">Pregunta <?php echo $key ?></a></li>
							<?php $contar++; ?>
						<?php endforeach ?>
					</ul>
					
					<div class="row">
		        		<div class="col-md-8 col-md-offset-2">
		        		
		        			<!--RECORRO LAS PREGUNTAS-->
							<?php foreach ($preguntas as $key => $pregunta): ?>
								<!--CONTENIDO DEL TAB-->
								<div id="pregunta<?php echo $key; ?>" data-interno="<?php echo $key; ?>" data-idpregunta="<?php echo $pregunta['id_p']; ?>">
									<div class="">
										<p class="text-info pregunta"><strong><?php echo $pregunta['pregunta']; ?></strong></p>
										<button type="button" id="cambiar_pregunta<?php echo $key; ?>" id-p="<?php echo $pregunta['id_p']; ?>" p="<?php echo $pregunta['pregunta']; ?>">
												<p> <img alt="Editar pregunta" src="<?php echo base_url(); ?>assets/img/edit.png"> </p>
										</button>
									</div>
									<!--PARA LA SUBIDA DE LA IMAGEN-->
									<?php if($pregunta['imagen'] == '') : ?>
									<div class="imagen">
										<h5>Agregar imagen a la pregunta.</h5>
										<div id="subida">
											<!--<?php echo $error; ?>-->
											<?php echo form_open_multipart( 'administrador/prueba2_controller/do_upload' );
												echo form_upload( 'userfile' );
												echo form_submit('upload', 'Asignar');

												echo form_hidden('id_p', $pregunta['id_p'] );
												echo form_close();
											?>
										</div>
									</div>
									<?php else: ?>
							        <!--PARA LA SUBIDA DE LA IMAGEN-->
							            <div class="imagen">
							               <a href="<?php echo base_url('assets/img/santos').'/'.$pregunta[ 'imagen' ]; ?>">
							                  <img src="<?php echo base_url('assets/img/santos').'/thumbs/'.$pregunta[ 'imagen' ]; ?>" alt="" class="img-polaroid">
							               </a>
							               <a class="btn btn-small" href="#"><i class="icon-trash"></i>Quitar</a>
							            </div>
									<?php endif; ?>
									<!--FIN PARA LA SUBIDA DE LA IMAGEN-->

									<!--SI HAY RESPUESTAS DEFINIDAS PARA EL EXAMEN-->
									<?php if (isset($respuestas) && $respuestas): ?>
										<?php $j=0; ?>
										<?php foreach ($respuestas as $llave => $respuesta) : ?>
											<!--SI EL INTERNO DE LA PREGUNTA COINCIDE CON EL INTERNO DE LA RESPUESTA -->
											<?php if( $pregunta['interno']== $llave ) : ?>
												<br>
												<div id="respuestas<?php echo $llave; ?>" data-interno="<?php echo $key; ?>">
													<?php foreach ($respuesta as $key => $value): ?>
														<!--<p id="pregunta"><?php echo $value['respuesta'] ?></p>-->
														<button id="modificar_respuesta" data-idpregunta="<?php echo $pregunta['id_p']; ?>" data-nrorespuesta="<?php echo $key; ?>" data-idrespuesta="<?php echo $value['id_r']; ?>" type="button" class="<?php if($value['correcto']== '1'){echo "btn btn-success";}else{ echo "btn btn-danger";}; ?>"><?php echo $value['respuesta'] ?></button><br><br>
													<?php endforeach ?>
												</div>
											<?php else: ?>
												<?php $j++; ?>
												<?php if( count($respuestas) == $j) : ?> <!--la cantidad de respuestas es igual a ...-->
													<p>Sin respuestas</p>
													<button type="button" id-i="<?php echo $key; ?>" id="definir_respuestas<?php echo $key; ?>" id-p="<?php echo $pregunta['id_p']; ?>" id-tp="<?php echo $pregunta['pregunta']; ?>" class="btn btn-success"><i class="icon-plus"></i></button>
												<?php endif; ?>
											<?php endif; ?>
											<!--FIN SI EL INTERNO DE LA PREGUNTA COINCIDE CON EL INTERNO DE LA RESPUESTA -->
										<?php endforeach; ?>
									<?php else: ?>
										No hay respuestas para el examen
										<br>
										<button type="button" id-i="<?php echo $key; ?>" id="definir_respuestas<?php echo $key; ?>" id-p="<?php echo $pregunta['id_p']; ?>" id-tp="<?php echo $pregunta['pregunta']; ?>" class="btn btn-success"><i class="icon-plus"></i></button>
									<?php endif; ?>
									<!--FIN SI HAY RESPUESTAS DEFINIDAS PARA EL EXAMEN-->
								</div>
				        		<!--FIN CONTENIDO DEL TAB-->
							<?php endforeach ?>
							<!--FIN RECORRO LAS PREGUNTAS-->
						
		        		</div>
		        		<!--INICIO span6 offset2-->
		        		
		        	</div>
		        	
				</div>
				<!--FIN PESTAÑAS-->
			<?php else : ?>
				<h2>No hay preguntas para el examen.</h2>
			<?php endif; ?>
			<!--FIN SI HAY PREGUNTAS DEFINIDAS PARA EL EXAMEN-->

		<!--SI EL EXAMEN NO ESTA HABILITADO-->
		<?php else: ?>
			<h2>El examen esta inhabilitado o no existe examen creado para este Grado</h2>
			<h3>Ir a la seccion de habilitar Examen</h3>
		<?php endif ?>
		<!--FIN SI EL EXAMEN ESTA HABILITADO-->
		<?php if ($habilitado && ( $contar < $cant_preguntas ) ): ?>
			<h3>Cantidad de preguntas totales del examen : <?php echo $cant_preguntas; ?></h3>
			<h3>Cantidad de preguntas hasta ahora : <?php echo $contar; ?></h3>
			<button id="nueva_pregunta" type="button" class="btn btn-primary">Ingrese primer pregunta</button>
		<?php endif ?>




<!-- DIALOGO QUE SALE CUANDO SE QUIERE AGREGAR UNA NUEVA PREGUNTA -->
		<div id="dialogo_nueva_pregunta" title="Nueva Pregunta">
			
			<h3>Agregar nueva pregunta al examen.</h3>
			<input type ="text" id="texto_nueva_pregunta">
			<input type ="hidden" id="hd_interno_pregunta">
			<p>Las preguntas se agregaran en orden de ingreso.</p>
			
		</div>
<!-- FIN DIALOGO QUE SALE CUANDO SE QUIERE AGREGAR UNA NUEVA PREGUNTA -->




		
<!-- DIALOGO QUE SALE CUANDO SE QUIERE AGREGAR UNA NUEVA PREGUNTA -->
		<div id="dialogo_cambiar_pregunta" title="Cambiar Pregunta">
			
			<h3>Cambiar pregunta del examen.</h3>
			<!--<input type ="text" id="texto_cambio_pregunta">-->
			<p id="texto_cambio_pregunta"></p>
			<input type="text" id="preg_m">
			<!--<input type ="text" id="interno_pregunta">-->
			
		</div>
<!-- FIN DIALOGO QUE SALE CUANDO SE QUIERE AGREGAR UNA NUEVA PREGUNTA -->
		
<!-- DIALOGO QUE SALE CUANDO SE QUIERE DEFINIR RESPUESTAS -->
		<div id="dialogo_definir_respuestas" title="Definir Respuestas">
			<h3>Definir Respuestas del examen.</h3>
			<p class="validateTips">Todos los campos son requeridos.</p>

			<!-- JDR: form validation error container -->
	        <div class="ui-widget ui-helper-hidden" id="errorblock-div1">
				<div class="ui-state-error ui-corner-all" style="padding: 0pt 0.7em;" id="errorblock-div2" style="display:none;"> 
					<p>
					   <!-- JDR: fancy icon -->
					   <span class="ui-icon ui-icon-alert" style="float: left; margin-right: 0.3em;"></span> 
		               <strong>Alert:</strong> Errors detected!
					</p>
					<!-- JDR: validation plugin will target this UL for error messages -->
					<ul></ul>
				</div>
			</div>



			<form id="formulario_agregar_respuestas" action="casa.php" method="POST">
				<fieldset>
					<p id="texto_pregunta"></p>
				<table>
					<tr>
					<div class="control-group">
						<td><input type="radio" name="radioRespuesta" id="check_1" value="1"></td>
						<td>
							<label for="resp1">Respuesta 1</label>
							<input type="text" name="resp1" id="resp1" class="text ui-widget-content ui-corner-all">
						</td>
					</div>
					</tr>
					<tr>
					<div class="control-group">
						<td><input type="radio" name="radioRespuesta" id="check_2" value="2"></td>
						<td>
							<label for="resp2">Respuesta 2</label>
							<input type="text" name="resp2" id="resp2" class="text ui-widget-content ui-corner-all">
						</td>
					</div>
					</tr>
					<tr>
					<div class="control-group">
						<td><input type="radio" name="radioRespuesta" id="check_3" value="3"></td>
						<td>
							<label for="resp3">Respuesta 3</label>
							<input type="text" name="resp3" id="resp3" class="text ui-widget-content ui-corner-all">
						</td>
					</div>
					</tr>
					<tr>
					<div class="control-group">
						<td><input type="radio" name="radioRespuesta" id="check_4" value="4"></td>
						<td>
							<label for="resp4">Respuesta 4</label>
							<input type="text" name="resp4" id="resp4" class="text ui-widget-content ui-corner-all">
						</td>
					</div>
					</tr>
				</table>
				</fieldset>
			</form>
		</div>
<!-- FIN DIALOGO QUE SALE CUANDO SE QUIERE DEFINIR RESPUESTAS -->
		
<!-- DIALOGO QUE SALE CUANDO SE QUIERE MODIFICAR RESPUESTAS -->
		<div id="dialogo_modificar_respuestas" title="Modificar Respuestas">
			<h3>Modificar Respuestas del examen.</h3>
			<p>Tilde el checkbox si quiere que sea la nueva respuesta correcta.</p>
	        <div class="ui-widget ui-helper-hidden" id="errorblock-div1">
				<div class="ui-state-error ui-corner-all" style="padding: 0pt 0.7em;" id="errorblock-div2" style="display:none;"> 
					<p>
					   <!-- JDR: fancy icon -->
					   <span class="ui-icon ui-icon-alert" style="float: left; margin-right: 0.3em;"></span> 
		               <strong>Alerta:</strong> Errores detectados!
					</p>

					<ul></ul>
				</div>
			</div>
			
			<form id="formulario_modificar_respuestas">
				<fieldset>
					<p id="texto_pregunta"></p>
					<table>
						<div class="control-group">
							<tr>
								<td><input type="checkbox" name="checkRespuesta"></td>
								<td>
									<label for="respuesta_m" id="labelrespuestam"></label>
									<input type="text" name="respuesta_m" id="respuesta_m" class="text ui-widget-content ui-corner-all">
								</td>
							</tr>
						</div>
					</table>
				</fieldset>
			</form>
		</div>
<!-- FIN DIALOGO QUE SALE CUANDO SE QUIERE MODIFICAR RESPUESTAS -->




		<hr>
		<row>
			<div class="col-md-4 col-md-offset-5">
				<p>&copy; Powered by Ricardo || 2014</p>
			</div>
		</row>
	</div>
	<!--<script src="<?php echo base_url('assets/js/jquery11.js'); ?>"></script>-->
	<script src="<?php echo base_url('assets/examen_usuario/jquery.custom/js/jquery-1.10.2.js'); ?>"></script>

  	<script src="<?php echo base_url('assets/examen_usuario/jquery.custom/js/jquery-ui-1.10.4.custom.js'); ?>"></script>
  	<script src="<?php echo base_url('assets/js/jquery.validate.js'); ?>" type="text/javascript"></script>
  	<script src="<?php echo base_url('assets/js/jquery.form.js'); ?>" type="text/javascript"></script>
  	<script src="<?php echo base_url('assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js');?>"></script>
  	<script type="text/javascript">
  	$(function (argument) {


  		//SI HAGO CLICK SOBRE CUALQUIER ELEMENTO QUE TENGA EL TEXTO definir_respuestas EN SU ID
		$("[id*=definir_respuestas]").click(function(event) {
			var pregunta = $( this ).attr("id-tp");
			$("#texto_pregunta").html( pregunta );		//ESCRIBO LA PREGUNTA EN EL DIALOG definir_respuestas

			var id_p = $( this ).attr("id-p");
			var interno = $( this ).attr("id-i");
			//LE PASO UNOS DATOS AL MODAL DEFINIR RESPUESTAS
			$("#dialogo_definir_respuestas").data('id_p',id_p);
			$("#dialogo_definir_respuestas").data('interno',interno);

			//POR ULTIMO ABRO EL MODAL PARA DEFINIR LAS RESPUESTAS
			$("#dialogo_definir_respuestas").dialog("open");
			//event.preventDefault();
		});
		//ME AVISA QUE SELECCIONE UN VALOR DE LOS RADIO BUTTON
		$("input[name=radioRespuesta]").change(function() {
			var valor = $( this).val();
			$( this ).attr('checked',true );
			//alert( $( this ).val() );
		});
		//VALIDACION
		var aForm = $('#formulario_agregar_respuestas').validate({
			// JDR: make sure we show/hide both blocks
			errorContainer: "#errorblock-div1, #errorblock-div2",
		    
			// JDR: put all error messages in a UL
			errorLabelContainer: "#errorblock-div2 ul",
		    
			// JDR: wrap all error messages in an LI tag
			wrapper: "li",

			rules: {
				resp1 :{
					required : true,
					minlength: 2,
					maxlength: 40,
				},
				resp2 :{
					required : true,
					minlength: 2,
					maxlength: 40,
				},
				resp3 :{
					required : true,
					minlength: 2,
					maxlength: 40,
				},
				resp4 :{
					required : true,
					minlength: 2,
					maxlength: 40,
				},
				radioRespuesta:{
					required : true,
				}
			},
			messages:{
				resp1 :{
					required: "Este campo es necesario",
					minlength: jQuery.format("Minimo {0} caracteres requeridos!"),
					maxlength: jQuery.format("Maximo {0} caracteres requeridos!"),
				},
				resp2 :{
					required: "Este campo es necesario",
					minlength: jQuery.format("Minimo {0} caracteres requeridos!"),
					maxlength: jQuery.format("Maximo {0} caracteres requeridos!"),
				},
				resp3 :{
					required: "Este campo es necesario",
					minlength: jQuery.format("Minimo {0} caracteres requeridos!"),
					maxlength: jQuery.format("Maximo {0} caracteres requeridos!"),
				},
				resp4 :{
					required: "Este campo es necesario",
					minlength: jQuery.format("Minimo {0} caracteres requeridos!"),
					maxlength: jQuery.format("Maximo {0} caracteres requeridos!"),
				},
				radioRespuesta : {
					required : "Debe elegir una pregunta como correcta",
				}
			},
			highlight: function(element) {				//cambia el imput de apariencia
				$(element).closest('.control-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element
				.text('OK!').addClass('valid')
				.closest('.control-group').removeClass('error').addClass('success');
			}

		});
		//FIN VALIDACION

		var interno = 0;
//PARA ABRIR LA VENTANA MODAL DE DEFINIR RESPUESTAS
		$("#dialogo_definir_respuestas").dialog({
			autoOpen : false,
			width    : 600,
			modal    : true,
			open     : function( event, ui) {
				var $led = $("#dialogo_definir_respuestas");
				interno = $led.data('interno');
				id_pregunta = $led.data('id_p');
				
				//console.log(interno);
			},
			buttons  : [
				{
					text : "Guardar",
					click : function(argument) {
						if ( $('#formulario_agregar_respuestas').valid() ) {
							var respuestas = {
								id_p  : id_pregunta,
								inte  : interno,
								resp1 : $("#resp1").val(),
								resp2 : $("#resp2").val(),
								resp3 : $("#resp3").val(),
								resp4 : $("#resp4").val(),
								correcta : $("input[name=radioRespuesta]:checked").val(),
							}
							console.log( respuestas );
							$.ajax({
								type     : 'POST',
					          	url      : '/Examen1/administrador/prueba2_controller/guardaRespuestas',
					          	dataType : 'text',
					          	data     : respuestas,

					          	success : function (data) {
					          		var Obj = JSON.parse( data );

					          		if ( Obj.guardado == 'Si' ) {
					          			alert("Respuestas guardadas correctamente");
					          		}else{
					          			alert("Las respuestas no se guardaron");
					          		};
					          		//AHORA RECARGO LA PAGINA
					          		setTimeout(function() {
			                            window.location.href = "<?php echo base_url() ?>administrador/prueba2_controller/";
			                          }, 
			                        2000
			                        );
					          	}
							});//FIN DE AJAX

						};//FIN DE click
					}
				},
				{
					text : "Cancelar",
					click : function(argument) {
						$( this ).dialog("close");
						aForm.resetForm(); 
					}
				}
			]
		});
//SI HAGO CLICK SOBRE CUALQUIER ELEMENTO QUE TENGA EL TEXTO modificar_respuestas EN SU ID
		$("[id=modificar_respuesta]").click(function(event) {
			//LE PASO AL DIALOGO LAS PREGUNTAS

			var interno = $( this ).closest('[id^=respuestas]').data('interno');
			var id_r    = $( this ).data("idrespuesta");
			//$("#labelrespuestam").html( 'Id respuesta : '+id_r );
			var nro_respuesta = $( this ).data("nrorespuesta");
			var id_p = $( this ).data("idpregunta");
			//nro_respuesta = nro_respuesta +1;
			$("#labelrespuestam").html( 'Nro respuesta : '+(nro_respuesta +1) );
			//console.log( $( this ).text() );
			$("#respuesta_m").val( $( this ).text() );
			//LE PASO UNOS DATOS AL MODAL DEFINIR RESPUESTAS
			$("#dialogo_modificar_respuestas").data('id_p',id_p);
			$("#dialogo_modificar_respuestas").data('id_r',id_r);
			$("#dialogo_modificar_respuestas").data('interno',interno);
			//ABRO LA VENTANA MODAL PARA MODIFICAR LAS RESPUESTAS
			$("#dialogo_modificar_respuestas").dialog("open");
		});
		var bForm = $("#formulario_modificar_respuestas").validate({
			// JDR: make sure we show/hide both blocks
			errorContainer: "#errorblock-div1, #errorblock-div2",
		    
			// JDR: put all error messages in a UL
			errorLabelContainer: "#errorblock-div2 ul",
		    
			// JDR: wrap all error messages in an LI tag
			wrapper: "li",

			rules: {
				respuesta_m :{
					required : true,
					minlength: 2,
					maxlength: 40,
				}
			},
			messages:{
				respuesta_m :{
					required: "Este campo es necesario",
					minlength: jQuery.format("Minimo {0} caracteres requeridos!"),
					maxlength: jQuery.format("Maximo {0} caracteres requeridos!"),
				}
			},
			highlight: function(element) {				//cambia el imput de apariencia
				$(element).closest('.control-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element
				.text('OK!').addClass('valid')
				.closest('.control-group').removeClass('error').addClass('success');
			}
		});
//PARA ABRIR LA VENTANA MODAL DE DEFINIR RESPUESTAS
		var id_preguntammm = 0;
		$("#dialogo_modificar_respuestas").dialog({
			autoOpen : false,
			width    : 600,
			modal    : true,
			open     :function(argument) {
				var $led       = $("#dialogo_modificar_respuestas");
				id_preguntammm = $led.data('id_p');
				id_respuesta   = $led.data('id_r');
				interno        = $led.data('interno');
			},
			buttons  : [
				{
					text : "Cambiar Pregunta",
					click : function(argument) {
						if ( $('#formulario_modificar_respuestas').valid() ) {
							var respuesta = {
								id_p     : id_preguntammm,          //en la BD
								id_r     : id_respuesta,			//en la BD
								inte     : interno,					//REFERIDA A LA PREGUNTA
								resp     : $("#respuesta_m").val(),	//DATO PARA EL UPDATE
								correcta : $("[name=checkRespuesta]").is(':checked')	//SI EL checkbox esta checkeado manda true, sino manda false
							}
							console.log( respuesta );

							$.ajax({
								type     : 'POST',
					          	url      : '/Examen1/administrador/prueba2_controller/modificaRespuesta',
					          	dataType : 'text',
					          	data     : respuesta,

					          	success : function (data) {
					          		var Obj = JSON.parse( data );

					          		if ( Obj.guardado == 'Si' ) {
					          			alert("Respuesta modificada correctamente");
					          		}else{
					          			alert("Las respuesta no se modifico");
					          		};
					          		//AHORA RECARGO LA PAGINA
					          		setTimeout(function() {
			                            window.location.href = "<?php echo base_url() ?>administrador/prueba2_controller/";
			                          }, 
			                        20
			                        );
					          	}
							});//FIN DE AJAX

						};//FIN DE click
					}
				},
				{
					text : "Cancelar",
					click : function(argument) {
						$( this ).dialog("close");
						bForm.resetForm(); 
					}
				}
			]
		});



  		//EVENTO QUE SE DISPARA CUANDO SE HACE CLICK SOBRE EL BOTON DE NUEVA PREGUNTA
  		$("#nueva_pregunta").click(function( event ) {
  			$("#dialogo_nueva_pregunta").dialog("open");
  			event.preventDefault();
  		});

  		//PARA ABRIR LA VENTANA MODAL DE AGREGAR NUEVA PREGUNTA
  		$( "#dialogo_nueva_pregunta" ).dialog({
	      autoOpen: false,
	      width: 500,
	      buttons: [
	        {
	          text: "Guardar",
	          click: function() {
	            var datosNuevaPregunta = {
	            	pregunta: $("#texto_nueva_pregunta").val(),
	            	grado   : "<?php echo $grado; ?>",
	            	interno : $("#hd_interno_pregunta").val(),
	            	id_examen : "<?php echo $id_examen; ?>"
	            }
	            console.log(datosNuevaPregunta);
	            $.ajax({
		          	type     : 'POST',
		          	url      : '/Examen1/administrador/prueba2_controller/multi',
		          	dataType : 'text',
		          	data     : datosNuevaPregunta,

		          	success : function (data) {
		          		//AHORA RECARGO LA PAGINA
		          		setTimeout(function() {
                            window.location.href = "<?php echo base_url() ?>administrador/prueba2_controller/";
                          }, 
                        2000
                        );
		          	}
		        });
		        $( this ).dialog( "close" );
	          }//FIN DE CLICK 
	        },
	        {
	          text: "Cancelar",
	          click: function() {
	            $( this ).dialog( "close" );
	          }
	        }
	      ]
	    });

		//SI HAGO CLICK SOBRE CUALQUIER ELEMENTO QUE TENGA EL TEXTO cambiar_pregunta EN SU ID
		$("[id*=cambiar_pregunta]").click(function(event) {
			var pregunta = $( this ).attr("p");
			//$("#texto_cambio_pregunta").val( pregunta );
			$("#texto_cambio_pregunta").html( pregunta );
			var id_p = $( this ).attr("id-p");
			$("#interno_pregunta").val( id_p );
			$("#dialogo_cambiar_pregunta").data('id_pregunta', id_p);		//AGREGADO
			$("#dialogo_cambiar_pregunta").dialog("open");
			event.preventDefault();
		});
		var id_pregunta = 0//PARA ABRIR LA VENTANA MODAL DE CAMBIAR UNA PREGUNTA
		$("#dialogo_cambiar_pregunta").dialog({
			autoOpen : false,
			width    : 600,
			open     : function( event, ui) {
				var $led = $("#dialogo_cambiar_pregunta");
				id_pregunta = $led.data('id_pregunta');
				//console.log(id);
			},
			buttons  : [
				{
					text : "Cambiar",
					click: function(argument) {
						var datosActualizar  = {
							id_p      : id_pregunta,
							//id_p    : $("#interno_pregunta").val(),
							//pregunta: $("#texto_cambio_pregunta").val()
							pregunta: $("#preg_m").val()
						}
						console.log(datosActualizar);
			            $.ajax({
				          	type     : 'POST',
				          	url      : '/Examen1/administrador/prueba2_controller/multi',
				          	dataType : 'text',
				          	data     : datosActualizar,

				          	success : function (data) {
				          		var Obj = JSON.parse( data );

				          		if ( Obj.guardado == 'Si' ) {
				          			alert("Modificado correctamente");
				          		}else{
				          			alert("La pregunta no se modifico");
				          		};
				          		//AHORA RECARGO LA PAGINA
				          		setTimeout(function() {
		                            window.location.href = "<?php echo base_url() ?>administrador/prueba2_controller/";
		                          }, 
		                        2000
		                        );
				          	}
				        });
				        $( this ).dialog( "close" );
					}//FIN DE click
				},
				{
					text : "Cancelar",
					click: function(argument) {
						$(this).dialog( "close" );
					}//FIN DE click
				}
			]
		});
		//NECESARIO PARA LAS PESTAÑAS DE LAS PREGUNTAS
		$( "#tabs" ).tabs({
	      	beforeLoad: function( event, ui ) {
		        ui.jqXHR.error(function() {		//si hay un error en el enlace (ajax/content1.html, ajax/content2.html,etc)
		          ui.panel.html(				//escribe en el panel correspondiente 
		            "No se puede cargar la pestaña. We'll try to fix this as soon as possible. " +
		            "If this wouldn't be a demo." );
	        });
	      }
	    });

		
  	});
  </script>
	<link rel="stylesheet" href="<?php echo base_url('assets/js/bootstrap.js'); ?>">
	<script src="<?php echo base_url('assets/js/jquery.validate.js');?>"></script>
	<script type="text/javascript">
		$(function (argument) {
			var interno = "<?php echo $contar; ?>";
	  		interno++;
	  		$("#hd_interno_pregunta").val(interno);
		});
	</script>
	<!--FIN CONTAINER-->
</body>
</html>