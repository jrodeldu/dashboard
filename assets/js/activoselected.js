$(document).ready(function(){
    
    $('#porfolio li').click(function(){
        $('#porfolio li').removeClass('activo');
        $(this).addClass('activo');
        var seccion = $(this).attr('id');
        
        if(seccion == 'dg'){
            $('#proyectos_dwa_dg dt').removeClass('activo');
            $('#proyectos_dwa_dg dt[id="dg_first"]').addClass('activo');
            $.galleriffic.gotoImage('11');
        }else if(seccion == 'dwa' || seccion == 'all'){
            $('#proyectos_dwa_dg dt').removeClass('activo');
            $('#proyectos_dwa_dg dt[id="dwa_first"]').addClass('activo');
            $.galleriffic.gotoImage('1');
        }
        
        if(seccion == 'pec' || seccion == 'tm'){
            // Animaciones en cascada para mostar la sección correspondiente
            if(seccion == 'pec'){
                $('#thumbs').fadeOut('slow', function(){
                    $('#gallery').fadeOut('fast', function(){
                        $('#text_tm').fadeOut('slow', function(){
                            $('#text_pec').fadeIn('slow');
                        });
                    });
                });                   
            }else{
                $('#thumbs').fadeOut('slow', function(){
                    $('#gallery').fadeOut('fast', function(){                        
                        $('#text_pec').fadeOut('slow', function(){
                            $('#text_tm').fadeIn('slow');
                        });
                    });
                }); 
            }      
        }else{
            $('#text_pec').fadeOut('slow', function(){
                $('#text_tm').fadeOut('slow', function(){
                    $('#thumbs').fadeIn('slow', function(){
                        $('#gallery').fadeIn('slow');    
                    });
                });
            });
        }
    });
    
    $('#proyectos_dwa_dg dt').click(function(){
        //var titulo = $(this).attr('class');
        //alert(titulo);
        
        $('#proyectos_dwa_dg dt').removeClass('activo');
        //$('#proyectos_dwa_dg dd').removeClass('activo');
        $(this).addClass('activo');
    });
    
});   