<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "login";
//$route['default_controller'] = "pdf_ci";
$route['404_override'] = '';
//$route['(:any)'] = 'login/login_user';
$route['admin'] = "administrador/login_admin";	//para el login del administador
$route['admin/(:any)'] = "administador/login_admin";
$route['panel'] = "principal/index";
/* End of file routes.php */
/* Location: ./application/config/routes.php */
