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
 * Class for generating HTTP responses
 */
class Response {
    protected $statusCode = 200;
    protected $headers = [];
    protected $content = '';
    
    /**
     * Sets the HTTP status code
     */
    public function setStatusCode($code) {
        $this->statusCode = $code;
        return $this;
    }
    
    /**
     * Adds HTTP header
     */
    public function setHeader($name, $value) {
        $this->headers[$name] = $value;
        return $this;
    }
    
    /**
     * Sets the response content
     */
    public function setContent($content) {
        $this->content = $content;
        return $this;
    }
    
    /**
     * Sends a response to the client
     */
    public function send() {
        http_response_code($this->statusCode);
        
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
        
        echo $this->content;
    }
    
    /**
     * Sends a JSON response
     */
    public function json($data) {
        $this->setHeader('Content-Type', 'application/json');
        $this->setContent(json_encode($data));
        $this->send();
    }
    
    /**
     * Redirects to another URL
     */
    public function redirect($url) {
        $this->setHeader('Location', $url);
        $this->setStatusCode(302);
        $this->send();
        exit;
    }
}