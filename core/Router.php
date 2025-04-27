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

/**
 * Router
 */
class Router {
    protected $routes = [];
    protected $request;
    protected $response;
    
    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }
    
    /**
     * Adding a route
     */
    public function addRoute($method, $pattern, $handler) {
        $this->routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'handler' => $handler
        ];
    }
    
    /**
     * Adding a GET route
     */
    public function get($pattern, $handler) {
        $this->addRoute('GET', $pattern, $handler);
    }
    
    /**
     * Adding a POST route
     */
    public function post($pattern, $handler) {
        $this->addRoute('POST', $pattern, $handler);
    }
    
    /**
     * search for a suitable route and call its handler
     */
    public function dispatch() {
        $method = $this->request->getMethod();
        $uri = $this->request->getUri();
        
        foreach ($this->routes as $route) {
            if ($route['method'] != $method) {
                continue;
            }
            
            // Convert the route template to a regular expression
            $pattern = $this->patternToRegex($route['pattern']);
            if (preg_match($pattern, $uri, $matches)) {
                // Remove the full match
                array_shift($matches);
                
                // Calling the handler
                $handler = $route['handler'];
                if (is_string($handler)) {
                    // If the handler is in the format "Controller@action"
                    list($controller, $action) = explode('@', $handler);
                    $controllerClass = "\\App\\Controllers\\$controller";
                    $controller = new $controllerClass();
                    return $controller->$action($this->request, $this->response, $matches);
                } else if (is_callable($handler)) {
                    // If the handler is a callback function
                    return call_user_func($handler, $this->request, $this->response, $matches);
                }
            }
        }
        
        // Route not found
        $this->response->setStatusCode(404);
        echo 'Page not found';
    }
    
    /**
     * Converts a route pattern to a regular expression
     */
    protected function patternToRegex($pattern) {
        // Replaces parameters of the form {param} with regular expressions
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $pattern);
        return '@^' . $pattern . '$@';
    }
}