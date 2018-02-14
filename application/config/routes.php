<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $route['default_controller'] = 'home';

//    $route['^en/(.+)$'] = "$1";
//    $route['^ar/(.+)$'] = "$1";
//    $route['^en$'] = $route['default_controller'];
//    $route['^ar$'] = $route['default_controller'];
    $route['404_override'] = 'home';
	$route['403'] = 'home';
	

    $route['ajax/upload'] = 'ajax/upload/';
//    $route['admin'] = 'admin/home/adminhomepage/';
//    $route['admin/login'] = 'admin/home/adminlogin/';
//    $route['admin/logout'] = 'admin/home/adminlogout/';
    //$route['admin/(:any)'] = 'admin/$1';
    $route['admin'] = 'admin/admin';
    $route['([a-z]{2})/redirect/(:any)'] = 'redirect/index';
    $route['([a-z]{2})/programs/page-(:any)'] = 'programs/index/$2';
    $route['([a-z]{2})/programs/filter/page-(:any)'] = 'programs/filter/$2';
    $route['([a-z]{2})/property/(:any)/(:any)/(:any)'] = 'property/index';
    $route['([a-z]{2})/destinations/(:any)'] = 'destinations/cities';
    $route['([a-z]{2})/destinations/(:any)/(:any)'] = 'destinations/city/$1/$2';
    $route['([a-z]{2})/destinations/moreHotels'] = 'destinations/moreHotels';
    $route['test'] = 'destinations/test';
    $route['([a-z]{2})/search/programs/(:any)'] = 'search/index';
    $route['([a-z]{2})/search/programs/(:any)/page-(:any)'] = 'search/index';
    $route['([a-z]{2})/search/hotels/(:any)'] = 'search/index';


    $route['^([a-z]{2})$'] = $route['default_controller'];
    $route['^([a-z]{2})/(.*)$'] = "$2";
    //$route['404_override'] = 'pages';
