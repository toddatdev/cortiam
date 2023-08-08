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
|	https://codeigniter.com/user_guide/general/routing.html
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

$route['test/zoom'] = 'test/zoom';

$route['default_controller'] = 'frontend';
$route['404_override'] = 'frontend/error_404';
$route['login'] = 'gate/login';
$route['logout'] = 'gate/logout';
$route['verify-email/(.+)'] = 'gate/verify_email/$1';
$route['validate'] = 'gate/validate';
$route['logmein'] = 'gate/user_login';
$route['forgot-password'] = 'gate/forgot_password';
$route['reset-password'] = 'gate/reset_password';
$route['reset-password/(.+)'] = 'gate/reset_password/$1';

$route['verify/email/(.+)'] = 'gate/verify_email/$1';

$route['api/rest/(.+)'] = 'api/rest/$1';

$route['ajax/backend/(.+)'] = 'backendprocess/$1';
$route['ajax/backend/(.+)/(.+)'] = 'backendprocess/$1/$2';

$route['ajax/(.+)'] = 'frontendprocess/$1';
$route['ajax/(.+)/(.+)'] = 'frontendprocess/$1/$2';

$route['cron/(.+)'] = 'cron/$1';
$route['cron/(.+)/(.+)'] = 'cron/$1/$2';


$route['cron/agentContactRatingReminder'] = 'cron/agentContactRatingReminder';


$route['ct-admin'] = 'backend/index';
$route['ct-admin/(.+)'] = 'backend/$1';
$route['ct-admin/(.+)/(.+)'] = 'backend/$1/$2';

$route['agent/ajax/(.+)'] = 'agentprocess/$1';
$route['agent/ajax/(.+)/(.+)'] = 'agentprocess/$1/$2';

$route['agent'] = 'agent/index';
$route['agent/(.+)'] = 'agent/$1';
$route['agent/(.+)/(.+)'] = 'agent/$1/$2';

$route['seller/ajax/(.+)'] = 'sellerprocess/$1';
$route['seller/ajax/(.+)/(.+)'] = 'sellerprocess/$1/$2';

$route['seller'] = 'seller/index'; 
$route['seller/zoom'] = 'test/zoom';

$route['seller/(.+)'] = 'seller/$1';
$route['seller/(.+)/(.+)'] = 'seller/$1/$2';


$route['buyer/ajax/(.+)'] = 'buyerprocess/$1';
$route['buyer/ajax/(.+)/(.+)'] = 'buyerprocess/$1/$2';

$route['buyer'] = 'buyer/index'; 
$route['buyer/zoom'] = 'test/zoom';

$route['buyer/(.+)'] = 'buyer/$1';
$route['buyer/(.+)/(.+)'] = 'buyer/$1/$2';

$route['skip'] = 'skip/index'; 




$route['test'] = 'test/testing';
$route['test/q'] = 'test/q';



//Review routes
//$route['reviews'] = "agent/review_form";

$route['(.+)'] = 'frontend/$1';
$route['(.+)/(.+)'] = 'frontend/$1/$2';



$route['translate_uri_dashes'] = TRUE;
