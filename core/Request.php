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
 * Class for working with HTTP requests
 */
class Request {
    protected $params = [];
    protected $query = [];
    protected $data = [];
    
    public function __construct() {
        $this->query = $_GET;
        $this->data = $_POST;
        
        // Decoding JSON requests
        if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
            $jsonData = json_decode(file_get_contents('php://input'), true);
            if ($jsonData) {
                $this->data = array_merge($this->data, $jsonData);
            }
        }
    }
    
    /**
     * Returns the request method (GET, POST, etc.)
     */
    public function getMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }
    
    /**
     * Returns the request URI
     */
    public function getUri() {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
    
    /**
     * Gets a parameter from a GET request
     */
    public function getQuery($key = null, $default = null) {
        if ($key === null) {
            return $this->query;
        }
        return isset($this->query[$key]) ? $this->query[$key] : $default;
    }
    
    /**
     * Gets a parameter from a POST request
     */
    public function getData($key = null, $default = null) {
        if ($key === null) {
            return $this->data;
        }
        return isset($this->data[$key]) ? $this->data[$key] : $default;
    }
    
    /**
     * Sets the route parameter
     */
    public function setParam($key, $value) {
        $this->params[$key] = $value;
    }
    
    /**
     * Gets the route parameter
     */
    public function getParam($key = null, $default = null) {
        if ($key === null) {
            return $this->params;
        }
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }
}