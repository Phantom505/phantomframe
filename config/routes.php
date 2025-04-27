<?php
/**
 * ---------------------------------------------------------------
 *                         PhantomFrame
 * ---------------------------------------------------------------
 *
 * Description:
 * PhantomFrame is a simple and lightweight PHP micro-framework
 * that demonstrates a solid understanding of MVC architecture,
 * routing, and database interaction. It is designed for developers
 * who need a straightforward, efficient solution for building
 * modern web applications
 *
 * @author    Imran Sultanov
 * @license   Public License - https://opensource.org/licenses/MIT
 * @requires  PHP >= 8.0
 *
 * ---------------------------------------------------------------
 */

/**
 * Application routes
 */

// Create Request and Response Objects Manually
$request = new \Core\Request();
$response = new \Core\Response();
$router = new \Core\Router($request, $response);

// Home page
$router->get('/', 'HomeController@index');

// Routes for users
$router->get('/users', 'UserController@index');
$router->get('/users/{id}', 'UserController@show');
$router->post('/users', 'UserController@store');
$router->post('/users/{id}', 'UserController@update');
$router->post('/users/{id}/delete', 'UserController@delete');

// API routes
$router->get('/api/users', 'Api\UserController@index');
$router->get('/api/users/{id}', 'Api\UserController@show');

// Static pages
$router->get('/about', function($request, $response) {
    $view = new \Core\View();
    $html = $view->render('pages/about');
    $response->setContent($html);
    $response->send();
});

$router->get('/contact', function($request, $response) {
    $view = new \Core\View();
    $html = $view->render('pages/contact');
    $response->setContent($html);
    $response->send();
});

// Add the router to the global scope for access from Application
global $router;