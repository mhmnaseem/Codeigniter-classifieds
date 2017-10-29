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



$route['default_controller'] = 'home';
$route['404_override'] = 'home/page_missing';
$route['translate_uri_dashes'] = FALSE;


$route['404'] = 'home/page_missing';


/* Custom Routes */

// auth
$route['login'] = "auth";
$route['register'] = "auth/register";
$route['forgotpassword'] = "auth/forgotpassword";
$route['validate-email/(:any)/(:any)'] = "auth/validate_email/$1/$2";
$route['change-password'] = "auth/newpwd";


// catergory

$route['category/(:any)'] = "home/category/$1";
$route['category/(:any)/(:num)'] = "home/category/$1/$2";

// Sub catergory

$route['subcategory/(:any)'] = "home/subcategory/$1";
$route['subcategory/(:any)/(:num)'] = "home/subcategory/$1/$2";

//single item

$route['item/(:any)'] = "home/singleItem/$1";

//single package

$route['package/(:any)'] = "home/singlepackage/$1";


// home page catergory

$route['party-items'] = "home/partyItems";
$route['party-items/(:num)'] = "home/partyItems/$1";

$route['foods'] = "home/foods";
$route['foods/(:num)'] = "home/foods/$1";

$route['games-activities-services'] = "home/games";
$route['games-activities-services/(:num)'] = "home/games/$1";

$route['venues'] = "home/venues";
$route['venues/(:num)'] = "home/venues/$1";

$route['party-packages'] = "home/partyPackages";
$route['party-packages/(:num)'] = "home/partyPackages/$1";

$route['food-packages'] = "home/foodPackages";
$route['food-packages/(:num)'] = "home/foodPackages/$1";

$route['faq'] = "home/faq";
$route['themes'] = "home/themes";

$route['search'] = "home/search";
$route['search/(:any)'] = "home/search/$1";
//$route['search/(:any)/(:num)'] = "home/search/$1/$2";
//$route['search/(:any)/(:any)/(:any)'] = "home/search/$1/$2/$3";
//$route['search/(:any)/(:any)/(:any)/(:num)'] = "home/search/$1/$2/$3/$4";
$route['contact'] = "home/contact";
$route['contactus'] = "home/contactus";



/* --- Seller Routes--- */
//profile
$route['profile'] = "seller/editprofile";
$route['phone-verify'] = "seller/phoneVerify";

$route['dashboard'] = "seller";

$route['change-my-password'] = "seller/changepassword";

//item
$route['post-item'] = "seller/additem";
$route['post-image'] = "seller/addImage";
$route['edit-item/(:any)'] = "seller/editItem/$1";
$route['manage-items'] = "seller/manageItems";
$route['delete-item/(:any)'] = "seller/deleteItem/$1";

//item-package
$route['post-package'] = "seller/addItemPackage";
$route['post-package-image'] = "seller/add_item_package_image";
$route['post-package-link-item'] = "seller/add_item_package_linked_Item";
$route['manage-packages'] = "seller/managePackages";
$route['edit-item-package/(:any)'] = "seller/editItemPackage/$1";
$route['edit-package-image/(:any)'] = "seller/edit_package_image/$1";
$route['edit-package-linked-items/(:any)'] = "seller/Edit_item_package_linked_Item/$1";
$route['delete-linked-item/(:num)/(:any)'] = "seller/delete_item_package_linked_Item/$1/$2";
$route['delete-item-package/(:any)'] = "seller/delete_item_package/$1";

// seller shop
$route['shops/(:any)'] = "home/sellerProfile/$1";
$route['shops/(:any)/(:num)'] = "home/sellerProfile/$1/$2";
$route['shop-settings'] = "seller/shopsettings";
$route['shop-analytics'] = "seller/shopAnalytics";
$route['contactseller/(:any)'] = "home/contactseller/$1";
$route['createshop/(:any)'] = "seller/createshop/$1";



//sitemap
$route['sitemap\.xml'] = "home/sitemap";
$route['sitemap-cat\.xml'] = "home/sitemap_Cat";
$route['sitemap-shop\.xml'] = "home/sitemap_shop";

