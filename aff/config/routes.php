<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Home/index';
$route['404_override'] = 'Home/Page404';
$route['translate_uri_dashes'] = FALSE;

$route['^en/(.+)$'] = '$1';
$route['^vi/(.+)$'] = '$1';
$route['^en$'] = $route['default_controller'];
$route['^vi$'] = $route['default_controller'];


$route['process'] = 'Home/process';
$route['account'] = 'Home/account';
$route['account/cong-tac-vien'] = 'Account/index';
$route['account.html'] = 'Home/account';
$route['account/dang-ky'] = 'Account/index';
$route['account/kich-hoat'] = 'Account/index';
$route['account/dang-nhap'] = 'Account/index';
$route['account/dang-xuat'] = 'Account/index';

$route['account/thong-tin'] = 'Account/index';

$route['account/quen-mat-khau'] = 'Account/index';
$route['account/lich-su-mua-hang'] = 'Account/index';
$route['account/thong-bao-cong-tac-vien'] = 'Account/index';
$route['account/thong-tin-cong-tac-vien'] = 'Account/index';
$route['account/cong-tac-vien-chuyen-doi'] = 'Account/index';
$route['account/thong-tin-thu-nhap'] = 'Account/index';
$route['account/thong-tin-chuyen-khoan'] = 'Account/index';
$route['account/xac-nhan-chuyen-khoan'] = 'Account/index';
$route['account/them-tai-khoan-ngan-hang'] = 'Account/index';

//http://localhost/aff/account/thong-bao-cong-tac-vien
//http://localhost/aff/account/thong-tin-cong-tac-vien
//http://localhost/aff/account/cong-tac-vien-chuyen-doi
//http://localhost/aff/account/thong-tin-thu-nhap
//http://localhost/aff/account/thong-tin-chuyen-khoan
//http://localhost/aff/account/xac-nhan-chuyen-khoan
//http://localhost/aff/account/them-tai-khoan-ngan-hang



//page
$route['(:any)'] = 'pages/view/$1';
