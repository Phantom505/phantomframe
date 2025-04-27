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
 * Class for working with views
 */
class View {
    protected $viewPath;
    protected $data = [];

    public function __construct($viewPath = null) {
        $this->viewPath = $viewPath ?? __DIR__ . '/../app/Views/';
    }
    
    /**
     * Sets the data for the view.
     */
    public function setData($key, $value = null) {
        if (is_array($key)) {
            $this->data = array_merge($this->data, $key);
        } else {
            $this->data[$key] = $value;
        }
        return $this;
    }
    
    /**
     * Renders the view and returns HTML
     */
    public function render($view, $data = []) {
        $data = array_merge($this->data, $data);
        $viewFile = $this->viewPath . $view . '.php';
        
        if (!file_exists($viewFile)) {
            throw new \Exception("View {$view} not found");
        }
        
        // Extract variables to local scope
        extract($data);
        
        // Buffer the output
        ob_start();
        include $viewFile;
        return ob_get_clean();
    }
}