<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Examen</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
  <style>
	  #feedback { font-size: 1.4em; }
	  #selectable .ui-selecting { background: #FECA40; }
	  #selectable .ui-selected { background: #F39814; color: white; }
	  #selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
	  #selectable li { margin: 3px; padding: 0.4em; font-size: 1.4em; height: 18px; width: 400px;}
  </style>
  <script type="text/javascript">
    $(function(event) {
      /*
    	$( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        console.log( $( this ).serialize() );
      });
      */
      $( "radio" ).onchange();
    });
  </script>
</head>
<body>
 
  <div id="tabs">
    <ul>
      <?php foreach ($preguntas as $key => $pregunta) : ?>
        <li><a href="#pregunta<?php echo $pregunta['interno']; ?>">Pregunta <?php echo $pregunta['interno']; ?></a></li>
      <?php endforeach; ?>
    </ul>
    
    <?php foreach ($preguntas as $key => $pregunta) : ?>
    <form action="<?php echo base_url(); ?>examen_controller/recibe" method="POST" class="form" role="form">
      <div id="pregunta<?php echo $pregunta['interno']; ?>">
        <h1>Pregunta <?php echo $pregunta['interno']; ?></h1>
        <p><?php echo $pregunta['pregunta']; ?></p>
        <?php foreach ($respuestas as $key => $respuesta) : ?>
          <?php if ( $pregunta['interno'] == $respuesta['interno']): ?>
            <input type="radio" name="<?php echo $respuesta['id_r'] ?>" class="respuesta" id="respuesta<?php echo $respuesta['id_r'] ?>" onchange="this.form.submit()"><?php echo $respuesta['respuesta'] ?>
          <?php endif ?>
        <?php endforeach; ?>
      </div><!--FIN id="pregunta..."-->
    </form>
    <?php endforeach; ?>

  </div><!--Fin TABS-->
  
</body>
</html>