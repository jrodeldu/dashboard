$(document).ready(function(){
    
    $("#contacto").validationEngine('attach');

    $('#bot').click(function(){
       
       if( $('#contacto').validationEngine('validate')){
                                    
            var form_data = {
                email: $('#email').val(),
                nombre: $('#nombre').val(),
                comentario: $('#comentario').val(),
                asunto: $('#asunto').val(),
                telefono: $('#telefono').val(),
                ajax: '1'
            };
            
            $.ajax({ 
                url:'http://www.it7.info/contacto/correo',
                data: form_data,
                type: 'POST',
                success: function(msg){
                    //alert(msg);
                    $('#con').html(msg);
                }
            });
            
        }
        
        return false;
    });
    
    
});
