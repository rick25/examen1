<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?php echo $titulo; ?></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
	<style type="text/css">
		.sort_asc :after{
			content: "▲";
		}
		.sort_desc :after{
			content: "▼";
		}
		.footer-below{
	      	padding: 25px 0px;
			/*background-color: #233140;*/
			background-color: #222;
			border-color: #080808;
			color: #FFF;
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
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
            <li><a href="<?php echo base_url('principal'); ?>">Inicio</a></li>
            <li><a href="#">Sobre</a></li>
            <li><a href="#">Contacto</a></li>
            <li class="dropdown active">
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
	        <h1>Notas</h1>
	        <p>Desde aquí podrá ver las notas de las alumnas organizadas por año y sección.</p>
	        <p>Puede también volver a habilitar el exámen a una alumna en particular.</p>
	    </div>
		<!--CONTENIDO-->
		<div class="row">
			<!--BARRA DE NAVEGACION IZQUIERDA-->
			<ul class="tabbable col-sm-3 nav nav-pills nav-stacked">
				<li class="nav-header">
					<div class="page-header">
				        <h3>Secundaria</h3>
				    </div>
				</li>
				<?php foreach ( $grados as $grado ): ?>
				<?php foreach ( $secciones as $key => $seccion ): ?>
					<?php if ( $grado['id_grado'] == $key && !is_array( $seccion ) ): ?>
				<li class=""><a href="#pregunta<?php echo $grado['id_grado']; ?>" data-toggle="tab"><?php echo $grado['nombre']; ?></a></li><!---->
					<?php elseif( $grado['id_grado'] == $key ) : ?>
				<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $grado['nombre']; ?></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<?php foreach ($seccion as $valor): ?>
						<li><a href="#pregunta<?php echo $grado['id_grado'].$valor; ?>" data-toggle="tab"><?php echo $grado['nombre'].' '.$valor; ?> </a></li>
					<?php endforeach ?>
					</ul>
				</li>
					<?php endif; ?>
				<?php endforeach ?>
				<?php endforeach ?>
			</ul>
			<!--FIN BARRA DE NAVEGACION IZQUIERDA-->
			<br>
			<!--CONTENIDO DE NAVEGACION DERECHA-->
			<div class="col-sm-8 tab-content">
				<!--<div id="status"></div>-->
				<?php foreach ( $grados as $key => $grado ): ?>
					<?php foreach ( $secciones as $key => $seccion ): ?>
						<?php if ( $grado['id_grado'] == $key && !is_array( $seccion ) ): ?>
				<div class="tab-pane" id="pregunta<?php echo $grado['id_grado']; ?>">
					<h1><?php echo $grado['nombre']; ?></h1>
					<table class="table table-striped table-hover">
						<thead>
							<?php foreach ( $campos as $nombre_campo => $campo_mostrar ): ?>
							<th <?php if( $sort_by == $nombre_campo ) echo "class=\"sort_$sort_order\""?>>
								<?php echo anchor( "administrador/administrar_evaluaciones/index/$nombre_campo/" . 
										( ( $sort_order == 'asc' && $sort_by == $nombre_campo ) ? 'desc' : 'asc' ),
										$campo_mostrar ); ?>
							</th>
							<?php endforeach; ?>
						</thead>
						<tbody>
							<?php foreach ( $datos_alumnos as $usuario ): ?>
							<?php if ( $usuario['grado'] == $grado['id_grado'] ): ?>
							<tr>
								<?php foreach ( $campos as $nombre_campo => $campo_mostrar ): ?>
									<?php if ( $nombre_campo == 'presento'): ?>
									<td>
										<button type="button" class="btn" id="boton_presento" id-cod="<?php echo $usuario['id']; ?>" id-estado="<?php echo $usuario['presento']; ?>"  data-content="Si ya presento entonces al cambiar estado la alumna podra volver a realizar el examen." rel="popover" data-original-title="Cambiar estado"><?php echo $usuario[$nombre_campo]; ?></button>
									</td>
									<?php elseif( $nombre_campo == 'nota' ) : ?>
									<td class="nota">
										<?php echo $usuario[$nombre_campo]; ?>
									</td>
									<?php else: ?>
									<td>
										<?php echo $usuario[$nombre_campo]; ?>
									</td>
									<?php endif ?>
								<?php endforeach; ?>
							</tr>
							<?php endif ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
						<?php elseif( $grado['id_grado'] == $key ) : ?>
							<?php foreach ($seccion as $valor): ?>
				<div class="tab-pane" id="pregunta<?php echo $grado['id_grado'].$valor; ?>">
					<h1><?php echo $grado['nombre'].' '.$valor; ?></h1>
					<table class="table table-striped table-hover">
						<thead>
							<?php foreach ( $campos as $nombre_campo => $campo_mostrar ): ?>
							<th <?php if( $sort_by == $nombre_campo ) echo "class=\"sort_$sort_order\""?>>
								<?php echo anchor( "administrador/administrar_evaluaciones/index/$nombre_campo/" . 
										( ( $sort_order == 'asc' && $sort_by == $nombre_campo ) ? 'desc' : 'asc' ),
										$campo_mostrar ); ?>
							</th>
							<?php endforeach; ?>
						</thead>
						<tbody>
							<?php foreach ( $datos_alumnos as $usuario ): ?>
							<?php if ( $usuario['grado'] == $grado['id_grado'] && $usuario['seccion'] == $valor ): ?>
							<tr>
								<?php foreach ( $campos as $nombre_campo => $campo_mostrar ): ?>
									<?php if ( $nombre_campo == 'presento'): ?>
									<td>
										<button type="button" class="btn" id="boton_presento" id-cod="<?php echo $usuario['id']; ?>" id-estado="<?php echo $usuario['presento']; ?>"  data-content="Si ya presento entonces al cambiar estado la alumna podra volver a realizar el examen." rel="popover" data-original-title="Cambiar estado"><?php echo $usuario[$nombre_campo]; ?></button>
									</td>
									<?php else: ?>
									<td>
										<?php echo $usuario[$nombre_campo]; ?>
									</td>
									<?php endif ?>
								<?php endforeach; ?>
							</tr>
							<?php endif ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
							<?php endforeach; ?>
						<?php endif; ?>
					<?php endforeach ?>
				<?php endforeach ?>
			</div>
			<!--CONTENIDO DE NAVEGACION DERECHA-->

		</div>
		<!--FIN CONTENIDO-->

		</div>
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
	</div>
	

	<script src="<?php echo base_url('assets/js/jquery11.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
	<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
	<script src="<?php echo base_url('assets/js/spin.js'); ?>"></script>
	<!--<script src="<?php echo base_url('assets/js/bootstrap222.js'); ?>"></script>-->
	<script src="<?php echo base_url('assets/js/tooltip.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/popover.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/button.js') ?>"></script>
	<script type="text/javascript">
	$(document).ready(function (argument) {
		/*muestra el panel de la primera pregunta al cargar por primera vez la pagina*/
    	$("[id^=pregunta]").each(function (argument) {
    		var v = $( this ).attr('id');
    		if ( v == 'pregunta1') {
    			$( this ).addClass('active');
    		};
    	});
		actualizar_botones();
		//MUESTRA UN MENSAJE POPOVER
		$('button#boton_presento').hover(function (argument) {
			var valor = $(this).attr('id-estado');
			if ( valor == '1') {
				$(this).popover('toggle');
			} else{

			};
		});	

		$('button#boton_presento').click(function (argument) {
			var id = $( this ).attr('id-cod');
			var presento = $( this ).attr('id-estado');
			if (presento == '1') {
				presento = '0';
		    } else{
				presento = '1';
		    };
			var Datos = {
				id : id,
				valor : presento
			};
			//console.log(presento);
			//var postUrl = '/Examen1/administrador/administrar_evaluaciones/cambiarEstado';
			var postUrl = '<?php echo base_url("administrador/administrar_evaluaciones/cambiarEstado"); ?>';
			$.ajax({
				type:'POST',
				url: postUrl,
				dataType : 'text',
				context : $(this),
				data : Datos,

				beforeSend: function (argument) {
					//$('#status').spin({radius:3,width:2,height:2,length:4});
				},
				success : function (response) {
					var obj = JSON.parse(response);
					//CAMBIA EL  ESTADO DEL BOTON
					if (obj.presento == '1') {
						$(this).attr('id-estado',obj.presento);

					}else{
						$(this).attr('id-estado',obj.presento);
					};
					actualizar_botones();
					cambiarNota();
				},
				error : function ( jqXHR,estado,error ) {
					console.log(estado);
					console.log(error);
				},
				complete: function ( jqXHR,estado ) {
					//console.log(estado);
				},
				timeout: 10000
			});

		});
		$('li a').click(function (e) {
			var valor = $(this).attr('href');
			var grado;
			var seccion;
			if (valor == '#') {
				grado = 'N';
				seccion = 'N';
			} else{
				grado = valor.substring(1, 2);
				seccion = valor.substring(2, 3);
			};
		});
	});
	function actualizar_botones (argument) {
		//compruebo el atributo id-estado de todos los botones
		$("button#boton_presento").each(function (argument) {
			var est = $(this).attr('id-estado');
			if ( est == '1') {
				$(this).html('Si');
				$(this).removeClass('btn-success','btn-danger');
				$(this).addClass('btn-success');
			} else{
				$(this).html('No');
				$(this).removeClass('btn-success','btn-danger');
				$(this).addClass('btn-danger');
			};
		});
	}
	function cambiarNota (argument) {
		$("td").each(function (argument) {
			if ( $(this).children("#boton_presento").html() == "No" ) {
				$( this ).siblings('.nota').text('0');
			};	
		});
	}
	</script>
</body>
</html>