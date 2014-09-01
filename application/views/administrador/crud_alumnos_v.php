<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.css" media="screen" />
    <title>Administrar Usuarios</title>
    <?php if(isset($ShowFlexgrid) and $ShowFlexgrid){
          echo '
      <link rel="stylesheet" type="text/css" href="'.base_url().'assets/js/flexigrid/flexigrid.css" />
      <script type="text/javascript" src="'.base_url().'assets/js/flexigrid/flexigrid.js"></script>
      ';
      } 
    ?>
<style>
  #header{
    padding: 15px 10px;
    font-size: 24px;
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

    <div class="jumbotron">
      <div class="container">
        <h1>Gestión de Alumnas</h1>
        <p>Desde aqui puede ver a todos los alumnos registrados.</p>
        <p>Podra ademas: Agregar alumnos, Modificar datos de alumno, Eliminar alumnos de la lista, Filtrar alumnos por Grado, Buscar alumnos</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button" href="<?php echo base_url() ?>principal/index">Volver al inicio &laquo;</a></p>-->
      </div>
    </div>

<!-- establecemos las configuraciones -->
<script type="text/javascript">
$(document).ready(function(event){
  //event.preventDefault();
  $("#flex1").flexigrid({

    /* indicamos la dirección del archivo que desde el servidor se encarga de
    acceder a la base de datos, puede ser un XML o una cadena en formato JSON
    devuelta por un archivo PHP, por ejemplo.
    */
    url: '<?php echo base_url(),'administrador/crud_alumnos_controller/get_json'; ?>',

    // indicamos en que formato se manejaran los datos
    dataType: 'json',

    /* establecemos una lista de columnas a usar, indicando :
      display  -> el nombre que vera el usuario
      name     -> nombre interno de la columna
      width    -> anchura de la columna
      sortable -> si la columna se puede ordenar
      align    -> la alineación del texto.
    */
    colModel : [
      {display: 'ID', name : 'id', width : 40, sortable : true, align: 'center'},
      {display: 'DNI', name : 'dni', width : 90, sortable : true, align: 'center'},
      {display: 'Nombre', name : 'nombre', width : 190, sortable : true, align: 'center'},
      {display: 'Apellido Paterno', name : 'apellido1', width : 150, sortable : true, align: 'center'},
      {display: 'Apellido Materno', name : 'apellido2', width : 150, sortable : true, align: 'center'},
      {display: 'Sexo', name : 'sexo', width : 80, sortable : true, align: 'center'},
      {display: 'Grado', name : 'grado', width : 80, sortable : true, align: 'center', hide: false},
      {display: 'Seccion', name : 'seccion', width : 80, sortable : true, align: 'center'},
      {display: 'Contraseña', name : 'password', width : 80, sortable : true, align: 'center', hide: true},
      {display: 'Nota', name : 'nota', width : 80, sortable : true, align: 'center'},
      {display: 'Presento', name : 'presento', width : 120, sortable : true, align: 'center'}
    ],

    /* agregamos los botones que apareceran en la barra de herramientas
    por ejemplo, botones para añadir, editar y eliminar registros.
    con la propiedad BClass indicamos el tipo de boton, se establecera asi
    la imagen de fondo para el botón
    ejemplo: {name: 'Eliminar', bclass: 'add', onpress : funcion_eliminar}
    */
                    
    buttons : [
      {name: 'Agregar', bclass: 'agregar', onpress : test, title:'Agregar nuevo registro'},
      {name: 'Editar', bclass: 'editar', onpress : test, title:'Editar registro'},
      {name: 'Eliminar', bclass: 'eliminar', onpress : test, title:'Eliminar registro(s)'},
      {name: 'Eliminar todo', bclass: 'eliminar_todo', onpress : test, title:'Eliminar todos los registros'},
      {name: 'Mostrar todo', bclass: 'mostrar_todo', onpress : filtro, title:'Mostrar todos los registros'},
      /*{separator: true},
      {name: '[Mostrar todo]', onpress: filtro},*/
      {separator: true}, // linea separadora
      {name: '1', onpress: filtro, title:'Filtrar por 1º grado'},
      {name: '2', onpress: filtro, title:'Filtrar por 2º grado'},
      {name: '3', onpress: filtro, title:'Filtrar por 3º grado'},
      {name: '4', onpress: filtro, title:'Filtrar por 4º grado'},
      {name: '5', onpress: filtro, title:'Filtrar por 5º grado'},
      {name: '6', onpress: filtro, title:'Filtrar por 6º grado'},
      /*
      {separator: true},
      {name: 'A', onpress: filtro},
      {name: 'B', onpress: filtro},
      {name: 'C', onpress: filtro},
      {name: 'D', onpress: filtro},
      {name: 'E', onpress: filtro},
      {name: 'F', onpress: filtro},
      {name: 'G', onpress: filtro},
      {name: 'H', onpress: filtro},
      {name: 'I', onpress: filtro},
      {name: 'J', onpress: filtro},
      {name: 'K', onpress: filtro},
      {name: 'L', onpress: filtro},
      {name: 'M', onpress: filtro},
      {name: 'N', onpress: filtro},
      {name: 'O', onpress: filtro},
      {name: 'P', onpress: filtro},
      {name: 'Q', onpress: filtro},
      {name: 'R', onpress: filtro},
      {name: 'S', onpress: filtro},
      {name: 'T', onpress: filtro},
      {name: 'U', onpress: filtro},
      {name: 'V', onpress: filtro},
      {name: 'W', onpress: filtro},
      {name: 'X', onpress: filtro},
      {name: 'Y', onpress: filtro},
      {name: 'Z', onpress: filtro}
      */
    ],

    // indicamos que columnas se pueden usar para filtrar las busquedas
    searchitems : [
      {display: 'Grado', name : 'grado', isdefault: true},
      {display: 'Seccion', name : 'seccion'},
      {display: 'Nombre', name : 'nombre'},
      {display: 'Apellido', name : 'apellido1'}
    ],

    // indicamos el nombre de la columna con la
    // q se ordenaran los registros por defecto
    sortname: 'id',

    // indicamos que por defecto los registros se mostraran ascendentemente
    sortorder: "asc",

    // esta propiedad permite activar o desactivar los botones de navegación de la página
    usepager: true,

    // titulo que aparecerá en la ventana
    title: 'Lista de Alumnos',

    // indicamos si se permite al usuario especificar el número de resultados por página.
    useRp: true,

    // numero de registros a mostrar, por defecto 30
    rp: 30,

    // esta propiedad permite establecer si se puede o no, minimizar la Flexigrid
    // (icono en la esquina superior derecha)
    showTableToggleBtn: true,

    // ancho de la flexigrid por defecto
    width: 1100,

    // alto de la flexigrid por defecto
    height: 600

  });
});

function redireccionar(sControlador){  
    $(location).attr('href',"<?php echo base_url(); ?>" + sControlador);
}

// funcion para los botones de filtro
function filtro(com){
   jQuery('#flex1').flexOptions({
      // indicamos los parametros del filtro
      newp:1, 
      params:[
         {name:'letter_pressed', value: com},
         {name:'qtype',value:$('select[name=qtype]').val()}
      ]
   });

   // recargamos la grid
   jQuery("#flex1").flexReload();
}

function test(com, grid){
        
    if (com == 'Agregar'){
        redireccionar('administrador/am_alumnos_controller/index/ins');
    
    }else if (com == 'Editar'){
        if($('.trSelected',grid).length==1){

               var items = $('.trSelected',grid);
               var itemlist='';
               for(i=0;i<items.length;i++){
                    itemlist+= items[i].id.substr(3);
		}
      redireccionar('administrador/am_alumnos_controller/index/upd/' + itemlist);

    }else if($('.trSelected',grid).length>1){
            alert('Sólo puede seleccionar un registro para editar..');
            return false;
	  }else {
            alert('Debe seleccionar un registro para poder actualizarlo..');
            return false;
    }
    
    }else if (com == 'Eliminar') {

        if($('.trSelected',grid).length>0){
            if(confirm('Ha seleccionado ' + $('.trSelected',grid).length + ' registro(s) ¿desea eliminarlo(s)?')){
                var items = $('.trSelected',grid);
                var resultado = new Array();
                for (var i = items.length - 1; i >= 0; i--) {
                  var itemlist = items[i].id;
                  resultado.push(itemlist.substr(3,4));//le agrego elemento a l Array
                  console.log(resultado);  
                };
                /*var itemlist = items[1].id;// id es la primera columna
                var resultado = itemlist.substr(3,4);//modificado, me salia Row# asi que le corte despues de Row 4 digitos adelante
                console.log(resultado);*/
		            $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo base_url(),'administrador/crud_alumnos_controller/eliminar_registros'; ?>",
                    data: "items="+resultado,
                    success: function(data){
                        alert("Se ha(n) eliminado un total de " + data.total + " registro(s).");
                        $("#flex1").flexReload();
                    }
                });
            }
	} else {
            alert('Debe seleccionar un registro pata poder eliminarlo..');
            return false;
        }
    }else if (com == 'Eliminar todo'){
        
        if(confirm('¿Realmente desea eliminar todos los registros de la tabla?')){
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '<?php echo base_url(),'administrador/crud_alumnos_controller/eliminar_todo'; ?>',
                data: "items=*",
                success: function(data){
                    alert("Se han eliminado todos los registros de la tabla.");
                    $("#flex1").flexReload();
                }
            });
	}
    }
}
</script>
<div class="row">
  <div class="container">
    <table id="flex1" style="display:none;font-size:18px;"></table>
  </div>
</div>

<!--<script src="<?php echo base_url('assets/js/jquery11.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
</body>
</html>
