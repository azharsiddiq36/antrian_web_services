<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*-- auth --*/
$route['login'] = 'AuthController/login';

/*-- components --*/
$route['settings/header'] = 'ComponentController/header';
$route['settings/footer'] = 'ComponentController/footer';
$route['settings/loket'] = 'ComponentController/loket';
$route['settings/parent'] = 'ComponentController/parent';
$route['settings/users'] = 'ComponentController/users';

/*-- second monitor --*/
$route['layanan'] = 'LayananController';
$route['layanan/registrasi'] = 'LayananController/registrasi';
$route['layanan/daftar'] = 'LayananController/lists';
$route['layanan/logout'] = 'LayananController/logout';

/*-- Extend Screen --*/
$route['extend'] = 'ExtendScreen';

/*-- devices per locket --*/
$route['devices'] = 'DevicesController';
$route['devices/registration'] = 'DevicesController/registration';

/*-- app routes --*/
$route['settings'] = 'AppController/settings';
$route['settings/colours'] = 'AppController/colours';
$route['settings/texts'] = 'AppController/texts';
$route['settings/audio'] = 'AppController/audio';
$route['settings/media'] = 'AppController/media';
$route['settings/print'] = 'AppController/prints';
$route['settings/header'] = 'ComponentController/header';
$route['settings/tombol'] = 'ComponentController/tombol';
$route['settings/shortcut'] = 'ComponentController/shortcut';

$route['api/queue/layanan'] = 'ApiController/layanan';
$route['api/queue/loket'] = 'ApiController/loket';
$route['api/queue/getantrian'] = 'ApiController/getAntrian';

$route['default_controller'] = 'AppController';
$route['mainpage'] = 'ResolutionController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['recallantrian'] = 'AntrianController/recall';
$route['callantrian'] = 'AntrianController/call';
$route['tambahantrian'] = 'AntrianController/tambah';
$route['antriansekarang'] = 'AntrianController/sekarang';
$route['sisaantrian'] = 'AntrianController/sisa';
$route['totalloket'] = 'AntrianController/countLocket';
$route['currentdata'] = 'AntrianController/antrian';
$route['tombol'] = 'AntrianController/index';
$route['total_antrian/(:any)']= 'AntrianController/getCount/$1';































