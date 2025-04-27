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
 * Base class for controllers
 */
abstract class Controller {
    protected $view;

    public function __construct() {
        $this->view = new View();
    }
    
    /**
     * Renders the view and sends a response
     */
    protected function render($view, $data = [], Response $response = null) {
        $html = $this->view->render($view, $data);
        
        if ($response) {
            $response->setHeader('Content-Type', 'text/html');
            $response->setContent($html);
            $response->send();
        } else {
            echo $html;
        }
    }
    
    /**
     * Sends a JSON response
     */
    protected function json($data, Response $response) {
        $response->json($data);
    }
    
    /**
     * Redirects to another URL
     */
    protected function redirect($url, Response $response) {
        $response->redirect($url);
    }
}