$(document).ready(function(){
  // Stuff to do as soon as the DOM is ready. Use $() w/o colliding with other libs;
  $('#calendar').fullCalendar({
            // put your options and callbacks here
            //theme: true,
            firstDay: 1, // Para que la semana empiece el Lunes
            weekMode: 'liquid',

            header:{
              left:   '',
                center: 'title',
                left:  'Hoy prev,next',
                right: 'month,agendaWeek,agendaDay'
            },
            //editable: false
            editable: true,
            events: function(start, end, callback) {
                $.ajax({
                    cache: false,
                    url: 'http://localhost/jrodeldu_modules/admin/calendario/get_events',
                    dataType: 'json',
                    success: function(doc) {
                        // recogemos el json de la función.
                        var events = eval(doc);
                        callback(events);
                    }
                });
            },
            eventClick: function(event) {
                //alert('clicked!');
                if (event.url) {
                    window.open(event.url, '_blank');
                    return false;
                }
            },
            eventDrop: function(event, dayDelta, revertAction) {
                var start = $.fullCalendar.formatDate(event.start, 'yyyy-MM-dd');
                var end = $.fullCalendar.formatDate(event.end, 'yyyy-MM-dd');
                //alert(start);
                //alert(end);
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: 'http://localhost/jrodeldu_modules/admin/calendario/update_event/'+event.id+'/'+start+'/'+end,
                    success: function(fun) {
                        $.gritter.add({
                          // (string | mandatory) the heading of the notification
                          title: event.title+' actualizado!',
                          // (string | mandatory) the text inside the notification
                          text: 'El evento se ha actualizado correctamente!',
                          // (bool | optional) if you want it to fade out on its own or just sit there
                          sticky: false,
                          // (int | optional) the time you want it to be alive for before fading out
                          time: '2000'
                        });

                        return false;
                    }
                });
            },
            eventResize: function(event, dayDelta, minuteDelta, revertFunc) {
                var start = $.fullCalendar.formatDate(event.start, 'yyyy-MM-dd');
                var end = $.fullCalendar.formatDate(event.end, 'yyyy-MM-dd');
                //alert(start);
                //alert(end);
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: 'http://localhost/jrodeldu_modules/admin/calendario/update_event/'+event.id+'/'+start+'/'+end,
                    success: function(fun) {
                        $.gritter.add({
                          // (string | mandatory) the heading of the notification
                          title: event.title+' actualizado!',
                          // (string | mandatory) the text inside the notification
                          text: 'El evento se ha actualizado correctamente!',
                          // (bool | optional) if you want it to fade out on its own or just sit there
                          sticky: false,
                          // (int | optional) the time you want it to be alive for before fading out
                          time: '2000'
                        });

                        return false;
                    }
                });
            }
        });
});