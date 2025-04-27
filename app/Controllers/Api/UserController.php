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
namespace App\Controllers\Api;

use Core\Controller;
use Core\Request;
use Core\Response;
use App\Models\User;

class UserController extends Controller {
    protected $userModel;
    
    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
    }
    
    /**
     * Get list of users (API)
     */
    public function index(Request $request, Response $response) {
        $users = $this->userModel->all();
        $this->json($users, $response);
    }
    
    /**
     * Get user data (API)
     */
    public function show(Request $request, Response $response, $params) {
        $id = $params[0];
        $user = $this->userModel->find($id);
        
        if (!$user) {
            $response->setStatusCode(404);
            $this->json(['error' => 'User not found'], $response);
            return;
        }
        
        $this->json($user, $response);
    }
}
