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
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



//Admin Module
$route['admin'] = 'Admin';


//Carousel Module

$route['Carousel'] = 'Carousel/Carousel';
$route['CreateCarousel'] = 'Carousel/CreateCarousel';
$route['UpdateCarousel'] = 'Carousel/UpdateCarousel';
$route['DeleteCarousel'] = 'Carousel/DeleteCarousel';
$route['ChangeStatus'] = 'Carousel/ChangeStatus';
$route['CarouselDetail/(:any)'] = 'Carousel/CarouselDetail/$1';
$route['SaveDetail'] = 'Carousel/SaveDetail';


//Users Module
$route['Users'] = 'Users/Users';
$route['CreateUser'] = 'Users/Users/CreateUser';
$route['Users'] = 'Users/Users';
$route['Users'] = 'Users/Users';
$route['Users'] = 'Users/Users';
$route['Users'] = 'Users/Users';


//Users Module
$route['Roles'] = 'Roles/Roles';
$route['CreateRole'] = 'Roles/Roles/CreateRole';
$route['UpdateRole'] = 'Roles/Roles/UpdateRole';
$route['DeleteRole'] = 'Roles/Roles/DeleteRole';
$route['Users'] = 'Users/Users';
$route['Users'] = 'Users/Users';





//Departements Module
$route['Departements'] = 'Departements/Departements';
$route['detaildepartements/(:any)'] = 'Departements/Departements/DepartementsDetail/$1';
$route['SaveDetaildepartement'] = 'Departements/Departements/SaveDetailDepartement';
$route['UpdateDepartement'] = 'Departements/Departements/UpdateDepartement';
$route['DeleteDepartement'] = 'Departements/Departements/DeleteDepartement';
$route['CreateDepartement'] = 'Departements/Departements/CreateDepartement';


//Event_type module

$route['Event_type'] = 'Event_type/Event_type';
$route['CreateEvent_type'] = 'Event_type/CreateEvent_type';
$route['UpdateEvent_type'] = 'Event_type/UpdateEvent_type';
$route['DeleteEvent_type'] = 'Event_type/DeleteEvent_type';
 $route['ChangeStatus'] = 'Event_type/ChangeStatus';
$route['Event_typeDetail/(:any)'] = 'Event_type/Event_typeDetail/$1';
$route['SaveDetailevent_type'] = 'Event_type/Event_type/SaveDetailevent_type';
	


// Event module
$route['Event'] = 'Event/Event';
$route['EventDetail/(:any)'] = 'Event/Event/EventDetail/$1';
$route['SaveDetailevent'] = 'Event/Event/SaveDetailevent';
$route['UpdateEvent'] = 'Event/Event/UpdateEvent';
$route['DeleteEvent'] = 'Event/Event/DeleteEvent';
$route['CreateEvent'] = 'Event/Event/CreateEvent';
$route['ChangeStatus'] = 'Event/ChangeStatus';

//mendyy

$route['Event_registration'] = 'Event_registration/Event_registration';
$route['Event_registration/Detail/(:any)'] = 'Event_registration/Event_registrationDetail/$1';
$route['SaveDetailevent_registration'] = 'Event_registration/Event_registration/SaveDetailevent_registration';
$route['UpdateEvent_registration'] = 'Event_registration/Event_registration/UpdateEvent_registration';
$route['DeleteEvent_registration'] = 'Event_registration/Event_registration/DeleteEvent_registration';
$route['CreateEvent_registration'] = 'Event_registration/Event_registration/CreateEvent_registration';
$route['ChangeStatus'] = 'Event_registration/ChangeStatus';
//Contact_message module

$route['Contact_message'] = 'Contact_message/Contact_message';
$route['CreateContact_message'] = 'Contact_message/CreateContact_message';
$route['UpdateContact_message'] = 'Contact_message/UpdateContact_message';
$route['DeleteContact_message'] = 'Contact_message/DeleteContact_message';
$route['ChangeStatus'] = 'Contact_message/ChangeStatus';
$route['Contact_messageDetail/(:any)'] = 'Contact_message/Contact_messageDetail/$1';
$route['SaveDetail'] = 'Contact_message/SaveDetail';



