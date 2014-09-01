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
    <style type="text/css">
      .dibu{
        margin-left: 200px;
      }
      .imagen{

      }
      .footer-below{
      	padding: 25px 0px;
		/*background-color: #233140;*/
		background-color: #222;
		border-color: #080808;
		color: #FFF;
      }
      .img-circle{
      	height: 200px;
      	weight: 300px;
      }
      .radio:hover{
      	/*
		background: #CC0000;
		text-decoration:underline;
		*/
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
            <li><a href="<?php echo base_url('login/logout_user'); ?>"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <!--fin navbar fija-->
	
	<!--inicio container-->
	<div class="container">
		<div class="jumbotron">
			<div>
			<h2> <?php echo $nombre; ?></h2>
      		</div>
		</div>
		<div class="row"><!--inicio contenido-->
			
			<div class="col-md-2"><!--inicio panel izquierdo-->
				<ul class="tabbable nav nav-pills nav-stacked">
				<?php foreach ($preguntas as $key => $pregunta) : ?>
				<?php if ( $pregunta['interno'] == 1 ): ?>
					<li class="active"><a href="#pregunta<?php echo $pregunta['interno']; ?>" data-toggle="tab">Pregunta <?php echo $pregunta['interno']; ?></a></li>
				<?php else: ?>
		    		<li><a href="#pregunta<?php echo $pregunta['interno']; ?>" data-toggle="tab">Pregunta <?php echo $pregunta['interno']; ?></a></li>
				<?php endif ?>
		    	<?php endforeach; ?>
				</ul>
			</div><!--fin panel izquierdo-->
			
			<div class="col-md-10 tab-content"><!--inicio panel derecho-->
		
				<?php foreach ($preguntas as $key => $pregunta) : ?>
	        	<div class="tab-pane" id="pregunta<?php echo $pregunta['interno']; ?>"><!--inicio tab-pane-->
					<div class="panel panel-primary"><!--inicio panel-->
						<div class="panel-heading text-center">
							<h3><strong><?php echo $pregunta['pregunta']; ?></strong></h3>
						</div>
						<div class="panel-body"><!--inicio panel-body-->
							<div class="container"><!--inicio container-->
								<div class="row"><!--inicio row-->
									<div class="col-md-4 col-md-offset-1"><!--inicio respuestas-->
										<?php foreach ($respuestas as $key => $respuesta) : ?>
							      		<?php if ( $pregunta['interno'] == $respuesta['interno']): ?>
							      		<div class="radio">
							      			<label>
								            	<input type="radio" id-p="<?php echo $pregunta['interno']; ?>" name="opcion<?php echo $pregunta['interno']; ?>" id="<?php echo $respuesta['id_r'] ?>"></input>
								            	<h4><?php echo $respuesta['respuesta'] ?></h4>
							      			</label>
							      		</div>
							      		<?php endif ?>
							            <?php endforeach; ?>
									</div><!--fin respuestas-->
									<div class="col-md-3 col-md-offset-1">
										<!--PARA VER LA IMAGEN DEL SANTO-->
						              	<div class="imagen">
						                <?php if( $pregunta['imagen'] != '' ) : ?>
						                	<img src="<?php echo base_url('assets/img/santos').'/'.$pregunta[ 'imagen' ]; ?>" alt="" class="img-circle">
						              	<?php endif; ?>
						              	</div>
						              	<!--FIN PARA VER LA IMAGEN DEL SANTO-->
									</div>	
								</div><!--fin row-->
				            </div><!--fin container-->
	            		</div><!--fin panel-body-->
	            		<div class="panel-footer">
	            			<p>Responda las preguntas indicando una opcion como correcta.</p> <p>Luego haga click en enviar</p>
	            		</div>
					</div><!--fin panel-->
	      		</div><!--fin tab-pane-->
	      		<?php endforeach; ?>
			
			</div><!--fin panel derecho-->
		</div><!--fin contenido-->
		
		<div class="row"><!--inicio boton enviar-->
			<div class="text-center">
				<div class="col-md-4 col-md-offset-4">
					<button type="button" class="btn btn-success btn-lg btn-block" id="enviar" data-toggle="modal" data-target="#modalEnviar">Enviar</button>
				</div>
			</div>
		</div><!--fin boton enviar-->
	</div>
	<hr>
	<!--fin container-->
	<footer class="text-center">
		<div class="footer-below">
		    <div class="container">
		        <div class="row">
		            <div class="col-lg-12">
		                	Copyright © 2014
		            </div>
		        </div>
		    </div>
		</div>
	</footer>
	<!--modal para enviar examen id="modalEnviar"-->
	<div class="modal fade" id="modalEnviar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title">¿Segura de enviar el examen?</h4>
	      </div>
	      <div class="modal-body">
	        <p>Tiene 4 preguntas respondidas.</p>
	        <p>Le falta por responder 6 preguntas.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
	        <button type="button" class="btn btn-success" id="confirmarEnvio">Enviar</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!--fin modal para enviar examen-->

	<!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="<?php echo base_url('assets/js/jquery11.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
    <script type="text/javascript">
    	$(document).on('ready',function (argument) {
    		/*muestra el panel de la primera pregunta al cargar por primera vez la pagina*/
    		$("[id^=pregunta]").each(function (argument) {
    			var v = $( this ).attr('id');
    			if ( v == 'pregunta1') {
    				$( this ).addClass('active');
    			};
    		});

    		//OCULTO EL BOTON ENVIAR QUE SIRVE PARA HABILITAR EL ENVIO DE LOS DATOS id="enviar"
  			$("#enviar").hide();
  			//SI SE HACE CLICK EN EL BOTON DE CONFIRMAR ENVIO id="confirmarEnvio"
  			$("#confirmarEnvio").on('click',function (argument) {
  				var myArray = [];
	            $("input[type='radio']:checked").each(function () {   //para cada elemento del DOM que tenga en su id la palabra respuesta y este checkeado
	              var id_r = $(this).attr('id');            //guardo el atributo id_r
	              var id_p = $(this).attr('id-p');          //guardo el atributo id_p
	              myArray[id_p] = id_r;
	            });
	            var objeto = a_Objeto(myArray);
	          
	            var postUrl = '/Examen1/' + 'usuario/examen_controller/recibe';
	            $.ajax({
					type     : 'POST',
					url      : postUrl,
					dataType : 'text',
					data     : objeto,
					success  : function(data) {
						var obj = JSON.parse(data);
						if ( obj.corregido == 'si' ) {
							setTimeout(function() {
								window.location.href = "<?php echo base_url('principal') ?>";
                          	}, 2000 );
						};
					}
	            });
  			});
  			
  			function makeCounter() {	//funcion que aumenta el valor de un contador en 1 cada vez que se le llama
		        var count = 0;
		        return function() {
		            count++;
		            return count;
		        };
		    };
		    var counter = makeCounter();		//llamo a la funcion makeCounter

  			//SI HAGO CLICK EN LOS INPUT RADIO 10 VECES 
		    $("input[type='radio']").click(function (event) {
		    	var i = counter();
		    	if (i >= 10 ) {
					$("#enviar").show();
				}
		    });
    	});
		//CONVIERTE UN ARRAY DE JAVASCRIPT EN UN OBJECT
	    function a_Objeto(array) {
	  	  var obj = {};
	  	  for (var i = 1; i < array.length; ++i)
	  	    obj[i] = array[i];
	  	  return obj;
	  	}
    </script>
</body>
</html>