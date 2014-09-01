<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title><?php echo $titulo; ?></title>
  <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/examen_usuario/jquery.custom/css/custom-theme/jquery-ui-1.10.4.custom.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
  <!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
  <script src="<?php echo base_url(); ?>assets/examen_usuario/jquery.custom/js/jquery-1.10.2.js"></script>
  <!--<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
  <script src="<?php echo base_url(); ?>assets/examen_usuario/jquery.custom/js/jquery-ui-1.10.4.custom.js"></script>
  <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
  <style>
	  #feedback { font-size: 1.4em; }
	  #selectable .ui-selecting { background: #FECA40; }
	  #selectable .ui-selected { background: #F39814; color: white; }
	  #selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
	  #selectable li { margin: 3px; padding: 0.4em; font-size: 1.4em; height: 18px; width: 400px;}
    body {
      padding-top: 60px;
      padding-bottom: 40px;
    }
    /*
    .titulo_pregunta{
      text-align: center;
    }
    */
    .pregunta{
      font-size: 150%;
      line-height: 120%;
    }
    .imagen img{
      float: right;
    }
  </style>
  <script type="text/javascript">
  $(function(event) {
  	//OCULTO EL BOTON ENVIAR QUE SIRVE PARA HABILITAR EL ENVIO DE LOS DATOS
  	$("#enviar").hide();

  	//ESTO ES PARA QUE FUNCIONE LAS PESTAÑAS
    $( "#tabs" ).tabs({
      	beforeLoad: function( event, ui ) {
	        ui.jqXHR.error(function() {		//si hay un error en el enlace (ajax/content1.html, ajax/content2.html,etc)
	          ui.panel.html(				//escribe en el panel correspondiente 
	            "No se puede cargar la pestaña. We'll try to fix this as soon as possible. " +
	            "If this wouldn't be a demo." );
        });
      }
    });

    //PARA LAS respuestas
    function armarArray(indice, valor) {
    	var respuestas = [];
    	return function() {
    		respuestas[indice] = valor;
    		return respuestas;
    	};
    };

    function makeCounter() {	//funcion que aumenta el valor de un contador en 1 cada vez que se le llama
        var count = 0;
        return function() {
            count++;
            return count;
        };
    };
    var counter = makeCounter();		//llamo a la funcion makeCounter

    //cada vez que hago click en el boton se imprime en la consola el valor de la variable
    $("#button").click(function () {
       var i = counter();
       console.log("The counter now is at " + i);

       // puedes actualizar un elemento contador
       //$("#counter").text('Tienes respondidas : ' +i + ' preguntas');
    });
    //CONVIERTE UN ARRAY DE JAVASCRIPT EN UN OBJECT
    function a_Objeto(array) {
  	  var obj = {};
  	  for (var i = 1; i < array.length; ++i)
  	    obj[i] = array[i];
  	  return obj;
  	}


    //SI HAGO CLICK EN LOS INPUT RADIO 10 VECES 
    $("input[type='radio']").click(function (event) {
    	//event.preventDefault();
    	var i = counter();
    	if (i >= 10 ) {
				$("#enviar").show();
			}
		$("#contador").text('Click : ' +i + ' veces en opciones');
    });
    //FIN PARA LAS RESPUESTAS

    $( "#radioset" ).buttonset();


    $( "#dialog" ).dialog({
      autoOpen: false,
      width: 400,
      buttons: [
        {
          text: "Enviar",
          click: function() {
            //$( this ).dialog( "close" );
            var myArray = [];
            $("input[type='radio']:checked").each(function () {   //para cada elemento del DOM que tenga en su id la palabra respuesta y este checkeado
              var id_r = $(this).attr('id');            //guardo el atributo id_r
              var id_p = $(this).attr('id-p');          //guardo el atributo id_p
              myArray[id_p] = id_r;
              //console.log( id_p + ' : ' +id_r );
            });
            //console.log(myArray);                 //BIEN BIEN BIEN!!!!
            var objeto = a_Objeto(myArray);
            //console.log(objeto);
          
            var postUrl = '/Examen1/' + 'usuario/examen_controller/recibe';
            //$.ajax({
            $.ajax({
              type: 'POST',
                    url: postUrl,
                    dataType: 'text',
                    data: objeto,

                    success : function (data) {
                      var obj = JSON.parse(data);
                      if (obj.corregido == 'si') {
                         //alert('Examen enviado');       //no tiene mucho sentido porque ya no esta en el examen
                        $("#nota").text(obj.nota);
                        //console.log(obj.nota);
                        setTimeout(function() {
                            window.location.href = "<?php echo base_url() ?>principal";
                          }, 
                        2000
                        );
                      };

                    }
            });//FIN DE .AJAX


          }
        },
        {
          text: "Cancelar",
          click: function() {
            $( this ).dialog( "close" );
          }
        }
      ]
    });

    // Link para abrir el dialogo
    $( "#enviar" ).click(function( event ) {
      $( "#dialog" ).dialog( "open" );
      event.preventDefault();
    });




  });

  </script>
</head>
<body>
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="#">Examen de Religion</a>
        <div class="nav-collapse collapse">
          <ul class="nav">
            <li class="active"><a href="#">Inicio</a></li>
            <li><a href="#about">Acerca</a></li>
            <li><a href="#contact">Contacto</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  
  <!--INICIO CONTAINER-->
  <div class="container">
    <div class="hero-unit">
      <h2>Bienvenid@ <?php echo $nombre; ?>!</h2>
      <p>Responda las preguntas indicando una opcion como correcta.</p> <p>Luego haga click en enviar</p>
    </div>
  

  <!--INICIO PESTAÑAS-->
  <div id="tabs">
    <ul>
    	<?php foreach ($preguntas as $key => $pregunta) : ?>
    		<li><a href="#pregunta<?php echo $pregunta['interno']; ?>"><?php echo $pregunta['interno']; ?></a></li>
    	<?php endforeach; ?>
    </ul>
      <!--INICIO ROW-->
      <div class="row">
        <div class="span8 offset2 well">
        <?php foreach ($preguntas as $key => $pregunta) : ?>
        	<div id="pregunta<?php echo $pregunta['interno']; ?>">
      			<h1 class="titulo_pregunta">Pregunta <?php echo $pregunta['interno']; ?></h1>
      			<p class="text-info pregunta"><strong><?php echo $pregunta['pregunta']; ?></strong></p>
              <!--PARA VER LA IMAGEN DEL SANTO-->
              <div class="imagen">
                <?php if( $pregunta['imagen'] != '' ) : ?>
                <img src="<?php echo base_url('assets/img/santos').'/thumbs/'.$pregunta[ 'imagen' ]; ?>" alt="" class="img-polaroid">
              <?php endif; ?>
              </div>
              <!--FIN PARA VER LA IMAGEN DEL SANTO-->
            <?php foreach ($respuestas as $key => $respuesta) : ?>
      				<?php if ( $pregunta['interno'] == $respuesta['interno']): ?>
                <input type="radio" id-p="<?php echo $pregunta['interno']; ?>" name="opcion<?php echo $pregunta['interno']; ?>" class="btn" id="<?php echo $respuesta['id_r'] ?>"><?php echo $respuesta['respuesta'] ?><br><br>
      				<?php endif ?>
            <?php endforeach; ?>
      		</div>
      	<?php endforeach; ?>
        </div>
      </div>
      <!--FIN ROW-->
  </div>
  <!--FIN PESTAÑAS-->
  <br><br>
  <div class="row">
    <div class="container">
      <div class="span3">
        <p><a class="btn btn-success btn-large" id="enviar">Enviar</a></p>
      </div>
    </div>
  </div>



  <!-- ui-dialog -->
  <div id="dialog" title="Enviar">
    <p>Esta por enviar su examen para ser corregido.</p>
    <p>Si esta seguro haga click en Enviar</p>
    <p>De lo contrario puede hacer en cancelar</p>
  </div>
  <!-- FIN ui-dialog -->


  <hr>
  <footer>
      <p>&copy; Powered by Ricardo || 2014</p>
  </footer>
  </div>
  <!--FIN CONTAINER-->

<!--<input type="button" id="enviar" value="ENVIAR RESPUESTAS">-->
<p id="contador"><strong></strong></p>
<p id="nota"></p>
  
</body>
</html>