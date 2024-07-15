<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'Pages/auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['api/v1/user/my'] = 'api/user/my';
$route['api/v1/user/insert'] = 'api/user/insert';
$route['api/v1/user/update'] = 'api/user/update';
$route['api/v1/user/passchange'] = 'api/user/update_password';
$route['api/v1/user/logout'] = 'api/user/logout';
$route['api/v1/user/create'] = 'api/user/create';

$route['api/v1/kelas/create'] = 'api/kelas/create';
$route['api/v1/kelas/delete'] = 'api/kelas/delete';
$route['api/v1/kelas/update'] = 'api/kelas/update';
$route['api/v1/kelas/get'] = 'api/kelas/get';

$route['api/v1/matakuliah/create'] = 'api/matakuliah/create';
$route['api/v1/matakuliah/delete'] = 'api/matakuliah/delete';
$route['api/v1/matakuliah/update'] = 'api/matakuliah/update';
$route['api/v1/matakuliah/get'] = 'api/matakuliah/get';
$route['api/v1/matakuliah/select2'] = 'api/matakuliah/select2';

$route['api/v1/ruang/create'] = 'api/ruang/create';
$route['api/v1/ruang/delete'] = 'api/ruang/delete';
$route['api/v1/ruang/update'] = 'api/ruang/update';
$route['api/v1/ruang/get'] = 'api/ruang/get';

$route['api/v1/dosen/create'] = 'api/dosen/create';
$route['api/v1/dosen/delete'] = 'api/dosen/delete';
$route['api/v1/dosen/update'] = 'api/dosen/update';
$route['api/v1/dosen/get'] = 'api/dosen/get';
$route['api/v1/dosen/ampuan/(:any)'] = 'api/dosen/ampuan/$1';

//APIs without cors or session limit
$route['api/v1/open/user/verify'] = 'api/open/verify';
$route['api/v1/open/session/check'] = 'api/open/check_session';
$route['api/v1/open/desa'] = 'api/open/desa';
$route['api/v1/open/ruang'] = 'api/open/ruang';


$route['auth'] = 'Pages/auth';
$route['dashboard'] = 'Pages/dashboard';
$route['kelas'] = 'Pages/kelas';
$route['dosen'] = 'Pages/dosen';
$route['ruang'] = 'Pages/ruang';
$route['matakuliah'] = 'Pages/matakuliah';


// $route['editor'] = 'Pages/editor';
// $route['kelas'] = 'Pages/kelas';
// $route['mahasiswa'] = 'Pages/mahasiswa';
// $route['jadwal'] = 'Pages/jadwal';
// $route['jadwalkuliah'] = 'Pages/jadwal_real';
// $route['jadwalkuliah2'] = 'Pages/jadwal_2';