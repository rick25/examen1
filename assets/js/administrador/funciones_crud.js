$(document).ready(function () {
    //editamos datos del usuario
    $(".editar").on('click', function () {

        var id = $(this).attr('id');
        var nombre = $("#nombre" + id).html();
        var apellido1 = $("#apellido1" + id).html();
        var apellido2 = $("#apellido2" + id).html();
        var sexo = $("#sexo" + id).html();
        var grado = $("#grado" + id).html();
        var seccion = $("#seccion" + id).html();

        $("<div class='edit_modal'><form name='edit' id='edit' method='post' action='http://localhost/Examen1/crud/multi_user'>"+
            "<label>Nombre</label><input type='text' name='nombre' class='nombre' value='"+nombre+"' id='nombre' /><br/>"+
            "<input type='hidden' name='id' class='id' id='id' value="+id+">"+
            "<label>Apellido paterno</label><input type='text' name='apellido1' class='apellido1' value='"+apellido1+"' id='apellido1' /><br/>"+
            "<label>Apellido materno</label><input type='text' name='apellido2' class='apellido2' value='"+apellido2+"' id='apellido2' /><br/>"+
            "<label>Sexo</label><input type='text' name='sexo' class='sexo' value='"+sexo+"' id='sexo' /><br/>"+
            "<label>Grado</label><input type='text' name='grado' class='grado' value='"+grado+"' id='grado' /><br/>"+
            "<label>Seccion</label><input type='text' name='seccion' class='seccion' value='"+seccion+"' id='seccion' /><br/>"+
            "</form><div class='respuesta'></div></div>").dialog({

                resizable:false,
                title:'Editar usuario.',
                height:300,
                width:450,
                modal:true,
                buttons:{
                    
                    "Editar":function () {
                        $.ajax({
                            url : $('#edit').attr("action"),
                            type : $('#edit').attr("method"),
                            data : $('#edit').serialize(),

                            success:function (data) {

                                var obj = JSON.parse(data);

                                if(obj.respuesta == 'error')
                                {
                                    
                                        $(".respuesta").html(obj.nombre + '<br />' + obj.email);
                                        return false;

                                }else{

                                    $('.edit_modal').dialog("close");

                                    $("<div class='edit_modal'>El usuario fué editado correctamente</div>").dialog({

                                        resizable:false,
                                        title:'Usuario editado.',
                                        height:200,
                                        width:450,
                                        modal:true

                                    });

                                    setTimeout(function() {
                                        window.location.href = "http://localhost/Examen1/crud";
                                    }, 2000);

                                }

                            }, 
                            error:function (error) {
                                $('.edit_modal').dialog("close");
                                $("<div class='edit_modal'>Ha ocurrido un error!</div>").dialog({
                                    resizable:false,
                                    title:'Error editando!.',
                                    height:200,
                                    width:450,
                                    modal:true
                                });
                            }

                        });
                        return false;
                    },
                    Cancelar:function () {
                        $(this).dialog("close");
                    }
                }
            }
        );
    });
 
    //eliminamos datos del usuario
    $(".eliminar").on('click', function () {

        var id = $(this).attr('id');
        var nombre = $("#nombre" + id).html();

        $("<div class='delete_modal'>¡Estás seguro que deseas eliminar al usuario " + nombre + "?</div>").dialog({

            resizable:false,
            title:'Eliminar al usuario ' + nombre + '.',
            height:200,
            width:450,
            modal:true,
            buttons:{

                "Eliminar":function () {
                    $.ajax({
                        type:'POST',
                        url:'http://localhost/Examen1/crud/delete_user',
                        async: true,
                        data: { id : id },
                        complete:function () {
                            $('.delete_modal').dialog("close");
                            $("<div class='delete_modal'>El usuario " + nombre + " fué eliminado correctamente</div>").dialog({
                                resizable:false,
                                title:'Usuario eliminado.',
                                height:200,
                                width:450,
                                modal:true
                            });

                            setTimeout(function() {
                                window.location.href = "http://localhost/Examen1/crud";
                            }, 2000);

                        }, error:function (error) {

                            $('.delete_modal').dialog("close");
                            $("<div class='delete_modal'>Ha ocurrido un error!</div>").dialog({
                                resizable:false,
                                title:'Error eliminando al usuario!.',
                                height:200,
                                width:550,
                                modal:true

                            });

                        }

                    });
                    return false;
                },
                Cancelar:function () {
                    $(this).dialog("close");
                }
            }
        });
    });
 
    //añadimos usuarios nuevos
    $(".agregar").on('click', function () {

        var id = $(this).attr('id');

        var nombre = $("#nombre" + id).html();

        $("<div class='insert_modal'><form name='insert' id='insert' method='post' action='http://localhost/Examen1/crud/multi_user'>"+
            "<label>Nombre</label><input type ='text' name='nombre' class='nombre' id='nombre' /><br/>"+
            "<label>Apellido paterno</label><input type ='text' name='apellido1' class='apellido1' id='apellido1' /><br/>"+
            "<label>Apellido materno</label><input type ='text' name='apellido2' class='apellido2' id='apellido2' /><br/>"+
            "<label>Sexo</label>            <input type ='text' name='sexo' class='sexo' id='sexo' /><br/>"+
            "<label>Grado</label>           <input type ='text' name='grado' class='grado' id='grado' /><br/>"+
            "<label>Seccion</label>         <input type ='text' name='seccion' class='seccion' id='seccion' /><br/>"+
            "</form><div class='respuesta'></div></div>").dialog({

            resizable:false,
            title:'Añadir nuevo usuario.',
            height:300,
            width:450,
            modal:true,
            buttons:{

                "Insertar":function () {
                    $.ajax({
                        url : $('#insert').attr("action"),
                        type : $('#insert').attr("method"),
                        data : $('#insert').serialize(),

                        success:function (data) {

                            var obj = JSON.parse(data);

                            if(obj.respuesta == 'error')        //SI EN EL ARRAY QUE VIENE DEL CONTROLADOR LA LLAVE RESPUSESTA TIENE EL VALOR ERROR
                            {
                                    $(".respuesta").html(obj.nombre + '<br />' + obj.apellido1 + '<br />' + obj.apellido2 + '<br />' + obj.sexo + '<br />' + obj.grado + '<br />' + obj.seccion);
                                    return false;

                            }else{
                                $('.insert_modal').dialog("close");
                                $("<div class='insert_modal'>El usuario fué añadido correctamente</div>").dialog({
                                    resizable:false,
                                    title:'Usuario añadido.',
                                    height:200,
                                    width:450,
                                    modal:true
                                });
                                setTimeout(function() {
                                    window.location.href = "http://localhost/Examen1/crud";
                                }, 2000);
                            }
                        }, error:function (error) {
                            $('.insert_modal').dialog("close");
                            $("<div class='insert_modal'>Ha ocurrido un error!</div>").dialog({
                                resizable:false,
                                title:'Error añadiendo!.',
                                height:200,
                                width:450,
                                modal:true
                            });
                        }
                    });
                    return false;
                },
                Cancelar:function () {
                    $(this).dialog("close");
                }
            }
        });
    });
});