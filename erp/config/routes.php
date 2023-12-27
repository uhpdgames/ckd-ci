<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = "dashboard";
$route['404_override'] = 'Dashboard/page404';
$route['500_override'] = 'Dashboard/page500';
$route['process'] = 'Dashboard/process';

$route['pages/(:any)'] = 'pages/view/$1';
