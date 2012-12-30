// Cargamos el muro con los mensajes.
function load_messages(id){
    //alert('estoy cargando...');
    $('#comentario_tarea').val(null);
    // después de load se ejecuta el callback que añade(attach) un evento a los elementos que nos hacen falta
    // para los eventos delete y edit. Función on().
    $('#comments').load('http://localhost/jrodeldu_modules/admin/tareas/get_comments/'+id, function(){
        $('a.delete').on('click', { id_tarea:id }, delete_message);
        $('form.editar_comentario').on('submit', { id_tarea:id }, edit_message);
        $('.alert').slideUp(3000);
    });
}

// Editar mensaje
function edit_message(evento){
    evento.preventDefault();
    // variables
    var id = evento.data.id_tarea; // Variable pasada en el callback dp de load();
    var url_edit = $(this).attr('action');
    // variable id comentario para localizar el modal a cerrar.
    var id_comentario = $(this).attr('id');
    $.ajax({
        type: 'POST',
        cache: false,
        url: url_edit,
        data: $(this).serialize(),
        success:function(msg){
            //alert('edit ajax');
            $('#myModal'+id_comentario).modal('hide');
            // Mostramos mensaje devuelto.
            $('#msg').html(msg);
            // Recarga del div de comentarios.
            load_messages(id);
        }
    });
}

// Eliminar mensaje
function delete_message(evento){
    evento.preventDefault();
    var id = evento.data.id_tarea;  // Variable pasada en el callback dp de load();
    var url_drop = $(this).attr('href');
    $.ajax({
        type: 'POST',
        dataType: 'HTML',
        cache: false,
        url: url_drop,
        success:function(msg){
            //alert('delete ajax');
            // Mostramos mensaje devuelto.
            $('#msg').html(msg);
            // Recarga del div de comentarios.
            load_messages(id);
        }
    });
}

function add_message(id, data){
    $.ajax({
        type: 'POST',
        dataType: 'HTML',
        cache: false,
        url: 'http://localhost/jrodeldu_modules/admin/tarea_comentario/add/'+id,
        data: "comentario_tarea="+data,
        success:function(msg){
            //alert('add ajax');
            $('#comentario_tarea').val(null);
            // Mostramos mensaje devuelto.
            //$('#msg').html(msg);
            // Recarga del div de comentarios.
            load_messages(id);
        }
    });
    return false;
}

$(document).ready(function(){

    // Variable global del id tarea.
    var id = $('#id_tarea').val();

    load_messages(id);

    // añadir mensaje
    $("#add_comentario").submit(function(evento){
        evento.preventDefault();
        var comentario = $('#comentario_tarea').val();
        add_message(id, comentario);
    });

}); // End Ready