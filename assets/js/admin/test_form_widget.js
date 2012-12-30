
$(document).ready(function(){

 $('.AdvancedForm').validate(
 {
  rules: {
    dni: {
      required: true,
      dni: true
    },
    fecha: {
        required: true,
        dateEU: true
    },
    email: {
        required: true,
        email: true
    },
    campo: {
        required: true,
        accept: "[a-zA-Z]+",
    },
    numero: {
        required: true,
        number: true
    },
    entero: {
        required: true,
        digits: true
    },
    password: {
        required: true,
        minlength: 6,
        maxlength: 16
    },
    confirmPassword: {
        required: true,
        minlength: 6,
        maxlength: 16,
        equalTo: "#password",
    },
    selection: {
        required: true
    },
    multiSelection: {
        required: true,
        minlength: 2,
    },
    ValidRadio: {
        required: true,
        maxlength: 1,
    },
    ValidCheckbox: {
        required: true,
        maxlength: 1,
    },
    calculo: {
        required: true,
        min: 100,
        max: 250,
    },
  },
  errorClass: "help-inline",
  errorElement: "span",
  highlight: function(label) {
    $(label).closest('.control-group').removeClass('success');
    $(label).closest('.control-group').addClass('error');
  },
  success: function(label) {
    label
      //.text('OK!').addClass('valid')
      .closest('.control-group').addClass('success');
  }
 });
});