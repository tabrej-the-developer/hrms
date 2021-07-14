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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['register'] = 'api/RegisterController/index';
$route['login'] = 'api/LoginController/index';
$route['logout'] = 'api/LoginController/logout';
$route['apps'] = 'api/AppController/index';
$route['app-dashboard'] = 'api/AppController/appDashboard';

$route['api/user/register'] = 'api/RegisterController/storeUser';
$route['api/user/verify/(:any)'] = 'api/RegisterController/verifyUser/$1';


$route['api/user/login'] = 'api/LoginController/login';
$route['api/user/update-password'] = 'api/LoginController/changePassword';
$route['api/user/add'] = 'api/UserController/postUser';
$route['api/user/delete/(:any)'] = 'api/UserController/removeUser/$1';
$route['api/user/update'] = 'api/UserController/updateUser';
$route['api/user/get/(:any)'] = 'api/UserController/getUserDetailedInfo/$1';
$route['api/child/add'] = 'api/UserController/storeChild';
$route['api/childs/add'] = 'api/UserController/addChild';
$route['api/childs/edit'] = 'api/UserController/editChild';
$route['api/parentchild/add'] = 'api/UserController/addParentChild';

$route['api/parent/add'] = 'api/UserController/storeParent';
$route['api/parent/edit'] = 'api/UserController/editParentDetails';
$route['api/parentname/edit'] = 'api/UserController/editParentName';

$route['api/center/add'] = 'api/CenterController/storeCenter';
$route['api/center/get/(:any)'] = 'api/CenterController/getCenter/$1';
$route['api/center/edit/(:any)'] = 'api/CenterController/editCenter/$1';
$route['api/center/logo/remove/(:any)'] = 'api/CenterController/removeLogoUrl/$1';
$route['api/center/logo/upload/(:any)'] = 'api/CenterController/uploadLogoUrl/$1';
$route['api/center/delete/(:any)'] = 'api/CenterController/removeCenter/$1';


$route['api/room/add'] = 'api/RoomController/storeRoom';
$route['api/room/get/(:any)'] = 'api/RoomController/getRoom/$1';
$route['api/room/edit/(:any)'] = 'api/RoomController/editRoom/$1';
$route['api/room/delete/(:any)'] = 'api/RoomController/removeRoom/$1';


$route['api/centerroom/add'] = 'api/RoomController/storeCenterRoom';

$route['api/company/getall'] = 'api/CompanyController/getCompanies';
$route['api/apps/getall'] = 'api/AppController/getApps';
$route['api/room/getall'] = 'api/RoomController/getAllRooms';
$route['api/center/getall'] = 'api/CenterController/getAllCenters';

$route['api/usercenter/add'] = 'api/CenterController/storeUserCenter';

