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
namespace Core;

class Application {
    public $router;
    public $request;
    public $response;
    protected $db;
    
    public function __construct() {
        $this->request = new Request();
        $this->response = new Response();
        
        // Get the global router or create a new one if it doesn't exist
        global $router;
        if (isset($router)) {
            $this->router = $router;
        } else {
            $this->router = new Router($this->request, $this->response);
        }
        
        $this->db = Database::getInstance();
    }
    
    /**
    * Launches the application
    */
    public function run() {
        try {
            // Process the request through the router
            $this->router->dispatch();
        } catch (\Exception $e) {
            // Handle errors
            $this->response->setStatusCode(500);
            echo 'Error: ' . $e->getMessage();
        }
    }
}