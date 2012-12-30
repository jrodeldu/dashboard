<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  User Auth Lang - Spanish
*
* Description:  Spanish language file for Ion Auth messages and errors
*
*/

// Account Creation
//$lang['account_creation_successful'] 	  	 = 'La cuenta ha sido creada';
$lang['account_creation_unsuccessful'] 	 	 = 'No se ha podido crear la cuenta inténtalo de nuevo.';
//$lang['account_creation_duplicate_email'] 	 = 'Email en uso o inválido';
//$lang['account_creation_duplicate_username'] = 'Nombre de usuario en uso o inválido';

// Password
$lang['check_password_change_unsuccessful'] 	 	 = 'La contraseña insertada es incorrecta';
$lang['password_change_successful'] 	 	 = 'La contraseña ha sido cambiada correctamente';
$lang['password_change_unsuccessful'] 	  	 = 'No se puede cambiar la constraseña';
/*
$lang['forgot_password_successful'] 	 	 = 'Enviado correo electrónico para restablecer contraseña';
$lang['forgot_password_unsuccessful'] 	 	 = 'No se puede restablecer la contraseña';
*/

// Activation

$lang['activate_successful'] 		  	     = 'Cuenta activada';
$lang['activate_unsuccessful'] 		 	     = 'No se puede activar la cuenta';
$lang['activate_unsuccessful_key'] 		 	 = 'Clave de activación incorrecta';
$lang['activation_email_successful'] 	  	 = 'En breve ecibirás un correo electrónico de activación de la cuenta, revisa tu bandeja de entrada.';
$lang['activation_email_unsuccessful']   	 = 'No se ha podido enviar el correo electrónico de activación, ponte en contacto con la administración.';
//$lang['deactivate_successful'] 		  	 = 'Cuenta desactivada';
//$lang['deactivate_unsuccessful'] 	  	     = 'No se puede desactivar la cuenta';

// Login / Logout
/*
$lang['login_successful'] 		  	         = 'Sesión iniciada';
*/
$lang['login_unsuccessful_user'] 		  	 = 'El usuario introducido no existe';
$lang['login_unsuccessful'] 		  	     = 'El usuario o la contraseña son incorrectos';
$lang['login_unsuccessful_not_active'] 		 = 'La cuenta está inactiva';
/*
$lang['logout_successful'] 		 	         = 'Se ha cerrado la sesión';
*/

// Account Changes

$lang['update_successful'] 		 	         = 'La información de la cuenta se ha actualizado correctamente';
$lang['update_unsuccessful'] 		 	     = 'No se ha podido actualizar la información de la cuenta';
/*
$lang['delete_successful'] 		 	         = 'El usuario ha sido borrado';
$lang['delete_unsuccessful'] 		 	     = 'No se puede borrar el usuario';
*/

// Email Subjects
//$lang['email_forgotten_password_subject']    = 'Verificación de la contraseña';
//$lang['email_new_password_subject']          = 'Nueva contraseña';
$lang['email_activation_subject']            = 'Activación de la cuenta';
$lang['invalid_date']                        = 'La Fecha es incorrecta o no está en el formato correcto dd/mm/yyyy';


//Mensajes bases CRUD
$lang['input_required'] 								= 'Campo requerido';
$lang['insert_successful'] 						= 'Se ha insertado correctamente';
$lang['insert_unsuccessful'] 					= 'No se han podido insertar los datos';
$lang['update_successful'] 						= 'Se ha ediado correctamente';
$lang['update_unsuccessful'] 					= 'No se han podido editar los datos';
$lang['delete_successful'] 						= 'Los datos se han eliminado correctamente';
$lang['delete_unsuccessful'] 					= 'No se han podido eliminar los datos';

//Subida de imagenes
$lang['upload_no_image'] 		 	         = 'No ha seleccionado ninguna imagen';
$lang['upload_image_successful'] 		 	     = 'Imagen subida perfectamente';
$lang['upload_image_unsuccessful'] 		 	 = 'No se ha podido insertar la imagen en la base de datos';