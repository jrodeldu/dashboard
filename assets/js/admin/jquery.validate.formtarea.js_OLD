$(document).ready(function(){

    // Formulario añadir/editar tareas
    // Incluye FIX para textareas con tiny
    $(function() {
        var validator = $(".myform").submit(function() {
          // update underlying textarea before submit validation
          tinyMCE.triggerSave();
        }).validate({
          ignore: "",
          rules: {
            proyecto: {
                required: true
            },
            entradilla:{
                required: true
            },
            tipo: {
                required: true
            },
            estado:{
                required: true
            },
            prioridad:{
                required: true
            },
            descripcion: "required"
          },
          errorClass: "help-inline",
          errorElement: "span",

          highlight: function(label) {
              $(label).closest('.control-group').removeClass('success');
              $(label).closest('.control-group').addClass('error');
          },
          success: function(label) {
              label
              .closest('.control-group').addClass('success');
          }

        });

        validator.focusInvalid = function() {
          // put focus on tinymce on submit validation
          if( this.settings.focusInvalid ) {
            try {
              var toFocus = $(this.findLastActive() || this.errorList.length && this.errorList[0].element || []);
              if (toFocus.is("textarea")) {
                tinyMCE.get(toFocus.attr("id")).focus();
              } else {
                toFocus.filter(":visible").focus();
              }
            } catch(e) {
              // ignore IE throwing errors when focusing hidden elements
            }
          }
        }
    });

});