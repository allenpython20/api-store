<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

$routes->get('/', 'Home::index');

$routes->group('api/products',['namespace'=>'App\Controllers\API' ],function($routes){

    $routes->get('','Product::index',['filter'=>['authFilter','roleFilter:all']]);
    $routes->post('create','Product::create',['filter'=>['authFilter','roleFilter:admin']]);
    $routes->put('edit/(:num)','Product::edit/$1');
    $routes->delete('delete/(:num)','Product::delete/$1');
    $routes->get('search','Product::search');
    $routes->get('(:num)','Product::get/$1',['filter'=>['authFilter','roleFilter:all']]);
});

$routes->group('api/category',['namespace'=>'App\Controllers\API' ],function($routes){

    $routes->get('','Category::index');
    $routes->post('create','Category::create',['filter'=>['authFilter']]);
    $routes->put('edit/(:num)','Category::edit/$1',['filter'=>['authFilter']]);
    $routes->delete('delete/(:num)','Category::delete/$1',['filter'=>['authFilter']]);
    $routes->get('products/(:num)','Category::searchProducts/$1',['filter'=>['authFilter']]);
    $routes->get('(:num)','Category::get/$1',['filter'=>['authFilter','roleFilter:all']]);

});

$routes->group('api/user',['namespace'=>'App\Controllers\API' ],function($routes){

    $routes->get('','User::index',['filter'=>['authFilter','roleFilter:admin']]);
    $routes->post('create','User::create',['filter'=>['authFilter','roleFilter:admin']]);
    $routes->put('edit/(:num)','User::edit/$1',['filter'=>['authFilter','roleFilter:admin']]);


});


$routes->group('auth',['namespace'=>'App\Controllers'],function($routes){

    $routes->post('login','Auth::login');
 

});

