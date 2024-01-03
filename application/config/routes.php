<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = 'Pagenotfound';
$route['translate_uri_dashes'] = true;

$route['setting'] = 'Setting';
$route['dashboard'] = 'Dashboard';
$route['pagenotfound'] = 'Pagenotfound';

$route['login'] = 'Login';
$route['login/signin'] = 'Login/signin';
$route['login/check_user_exist'] = 'Login/check_user_exist';
$route['login/signup'] = 'Login/signup';

$route['logout'] = 'Logout';
$route['logout/signout'] = 'Logout/signout';

$route['task'] = 'Task';
$route['task/create'] = 'Task/create';
$route['task/save_task'] = 'Task/save_task';
$route['task/today'] = 'Task/today';
$route['task/yesterday'] = 'Task/yesterday';
$route['task/last_week'] = 'Task/last_week';

$route['category'] = 'Category';
$route['category/create'] = 'Category/create';
$route['category/delete'] = 'Category/delete';
$route['category/update'] = 'Category/update';

$route['clients'] = 'Clients';
$route['clients/create'] = 'Clients/create';
$route['clients/delete'] = 'Clients/delete';
$route['clients/update'] = 'Clients/update';

$route['staff'] = 'Staff';
$route['staff/create'] = 'Staff/create';
$route['staff/delete'] = 'Staff/delete';
$route['staff/save_staff'] = 'Staff/save_staff';

$route['roles'] = 'Roles';
$route['roles/create'] = 'Roles/create';
$route['roles/delete'] = 'Roles/delete';
$route['roles/update'] = 'Roles/update';

$route['profile'] = 'Profile';
$route['forgetpassword'] = 'Forgetpassword';

