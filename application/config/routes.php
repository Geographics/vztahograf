<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route["persons"] = "persons";
$route["persons/create"] = "persons/create";
$route["persons/update/(:any)"] = "persons/update/$1";
$route["persons/delete/(:any)"] = "persons/delete/$1";
$route["persons/(:any)"] = "persons/view/$1";

$route["organizations"] = "organizations";
$route["organizations/create"] = "organizations/create";
$route["organizations/update/(:any)"] = "organizations/update/$1";
$route["organizations/delete/(:any)"] = "organizations/delete/$1";
$route["organizations/(:any)"] = "organizations/view/$1";

$route["positions"] = "positions";
$route["positions/create"] = "positions/create";
$route["positions/update/(:any)"] = "positions/update/$1";
$route["positions/delete/(:any)"] = "positions/delete/$1";
$route["positions/(:any)"] = "positions/view/$1";

$route["events"] = "events";
$route["events/create"] = "events/create";
$route["events/update/(:any)"] = "events/update/$1";
$route["events/delete/(:any)"] = "events/delete/$1";
$route["events/(:any)"] = "events/view/$1";

$route["in_positions"] = "in_positions";
$route["in_positions/create"] = "in_positions/create";
$route["in_positions/update/(:any)"] = "in_positions/update/$1";
$route["in_positions/delete/(:any)"] = "in_positions/delete/$1";
$route["in_positions/(:any)"] = "in_positions/view/$1";

$route["in_events"] = "in_events";
$route["in_events/create"] = "in_events/create";
$route["in_events/update/(:any)"] = "in_events/update/$1";
$route["in_events/delete/(:any)"] = "in_events/delete/$1";
$route["in_events/(:any)"] = "in_events/view/$1";

$route["relations"] = "relations";
$route["relations/create"] = "relations/create";
$route["relations/update/(:any)"] = "relations/update/$1";
$route["relations/delete/(:any)"] = "relations/delete/$1";
$route["relations/(:any)"] = "relations/view/$1";

$route["organizations_types"] = "organizations_types";
$route["organizations_types/create"] = "organizations_types/create";
$route["organizations_types/update/(:any)"] = "organizations_types/update/$1";
$route["organizations_types/delete/(:any)"] = "organizations_types/delete/$1";
$route["organizations_types/(:any)"] = "organizations_types/view/$1";

$route["events_types"] = "events_types";
$route["events_types/create"] = "events_types/create";
$route["events_types/update/(:any)"] = "events_types/update/$1";
$route["events_types/delete/(:any)"] = "events_types/delete/$1";
$route["events_types/(:any)"] = "events_types/view/$1";

$route["positions_types"] = "positions_types";
$route["positions_types/create"] = "positions_types/create";
$route["positions_types/update/(:any)"] = "positions_types/update/$1";
$route["positions_types/delete/(:any)"] = "positions_types/delete/$1";
$route["positions_types/(:any)"] = "positions_types/view/$1";

$route["relations_types"] = "relations_types";
$route["relations_types/create"] = "relations_types/create";
$route["relations_types/update/(:any)"] = "relations_types/update/$1";
$route["relations_types/delete/(:any)"] = "relations_types/delete/$1";
$route["relations_types/(:any)"] = "relations_types/view/$1";

$route["tags_types"] = "tags_types";
$route["tags_types/create"] = "tags_types/create";
$route["tags_types/update/(:any)"] = "tags_types/update/$1";
$route["tags_types/delete/(:any)"] = "tags_types/delete/$1";
$route["tags_types/(:any)"] = "tags_types/view/$1";

$route["news/(:any)"] = "news/view/$1";
$route["news/create"] = "news/create";
$route["news"] = "news";

$route['api'] = "api";

$route['graph'] = "graph";
$route['default_controller'] = "pages/view";

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */