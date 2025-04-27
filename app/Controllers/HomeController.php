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
namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;

class HomeController extends Controller {

    public function index(Request $request, Response $response) {
        $data = [
            'title' => 'Main page',
            'content' => 'Welcome to our framework!'
        ];
        
        $this->render('home/index', $data, $response);
    }
}