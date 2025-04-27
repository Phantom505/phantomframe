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

// Load the class autoloader
require_once 'core/Autoloader.php';

// Let's connect the configuration files
require_once 'config/config.php';


if (defined('DEBUG') && DEBUG === true) {
    error_reporting(E_ALL); 
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
}

// Initialize request and response objects before loading routes
$request = new \Core\Request();
$response = new \Core\Response();

// Connect the routes after initializing the request and response
require_once 'config/routes.php';

// Let's launch our framework
$app = new \Core\Application();
$app->run();