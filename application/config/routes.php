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

$route['api/v1/ruang/create'] = 'api/ruang/create';
$route['api/v1/ruang/delete'] = 'api/ruang/delete';
$route['api/v1/ruang/update'] = 'api/ruang/update';
$route['api/v1/ruang/get'] = 'api/ruang/get';

$route['api/v1/mahasiswa/create'] = 'api/mahasiswa/create';
$route['api/v1/mahasiswa/delete'] = 'api/mahasiswa/delete';
$route['api/v1/mahasiswa/update'] = 'api/mahasiswa/update';
$route['api/v1/mahasiswa/get'] = 'api/mahasiswa/get';
$route['api/v1/mahasiswa/searchnim'] = 'api/mahasiswa/searchnim';
$route['api/v1/mahasiswa/get_in'] = 'api/mahasiswa/get_in';

$route['api/v1/dosen/create'] = 'api/dosen/create';
$route['api/v1/dosen/delete'] = 'api/dosen/delete';
$route['api/v1/dosen/update'] = 'api/dosen/update';
$route['api/v1/dosen/get'] = 'api/dosen/get';

$route['api/v1/relasi/create'] = 'api/relasi/create';
$route['api/v1/relasi/delete'] = 'api/relasi/delete';
$route['api/v1/relasi/update'] = 'api/relasi/update';
$route['api/v1/relasi/get'] = 'api/relasi/get';
$route['api/v1/relasi/detailed'] = 'api/relasi/get_detailed';
$route['api/v1/relasi/schedule'] = 'api/relasi/get_schedule';

//APIs without cors or session limit
$route['api/v1/open/user/verify'] = 'api/open/verify';
$route['api/v1/open/session/check'] = 'api/open/check_session';
$route['api/v1/open/desa'] = 'api/open/desa';
$route['api/v1/open/ruang'] = 'api/open/ruang';


$route['auth'] = 'Pages/auth';
$route['dashboard'] = 'Pages/dashboard';
$route['editor'] = 'Pages/editor';
$route['ruang'] = 'Pages/ruang';
$route['kelas'] = 'Pages/kelas';
$route['mahasiswa'] = 'Pages/mahasiswa';
$route['dosen'] = 'Pages/dosen';
$route['jadwal'] = 'Pages/jadwal';
$route['jadwalkuliah'] = 'Pages/jadwal_real';
$route['jadwalkuliah2'] = 'Pages/jadwal_2';