<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Configuración general
 */
$config['site_title']           = "IT7.info"; 		// Site Title, example.com
$config['admin_email']          = "no-reply@it7.info"; 	// Admin Email, admin@example.com
$config['min_password_length']  = 6; 					// Minimum Required Length of Password
$config['max_password_length']  = 20; 					// Maximum Allowed Length of Password
$config['identity']             = 'email'; 				// Campo identidad único para diferenciar entre usuarios.

/**
 * Configuración para el E-Mail
 */
$config['config_email'] = array(
	                        'mailtype'  => 'html',
	                        'charset'   => 'UTF-8'
	                     );
/* End of file users_auth.php */
/* Location: ./application/config/users_auth.php */
