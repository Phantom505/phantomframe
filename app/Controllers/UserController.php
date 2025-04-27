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
use App\Models\User;

class UserController extends Controller {
    protected $userModel;
    
    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
    }
    
    /**
     * User list
     */
    public function index(Request $request, Response $response) {
        $users = $this->userModel->all();
        
        $this->render('users/index', [
            'title' => 'Users',
            'users' => $users
        ], $response);
    }
    
    /**
     * Show users
     */
    public function show(Request $request, Response $response, $params) {
        $id = $params[0];
        $user = $this->userModel->find($id);
        
        if (!$user) {
            $response->setStatusCode(404);
            echo 'User not found';
            return;
        }
        
        $this->render('users/show', [
            'title' => 'User profile',
            'user' => $user
        ], $response);
    }
    
    /**
     * Create user
     */
    public function store(Request $request, Response $response) {
        $data = $request->getData();
        
        $errors = [];
        if (empty($data['name'])) {
            $errors['name'] = 'Name is required';
        }
        if (empty($data['email'])) {
            $errors['email'] = 'Email is required';
        }
        
        if (!empty($errors)) {
            $this->render('users/create', [
                'title' => 'Create user',
                'errors' => $errors,
                'data' => $data
            ], $response);
            return;
        }
        
        // Create a user
        $id = $this->userModel->create($data);
        
        // Redirect to the user page
        $this->redirect(BASE_URL . "users/{$id}", $response);
    }
    
    /**
     * Update user
     */
    public function update(Request $request, Response $response, $params) {
        $id = $params[0];
        $data = $request->getData();
        
        // Checking the existence of the user
        $user = $this->userModel->find($id);
        if (!$user) {
            $response->setStatusCode(404);
            echo 'User not found';
            return;
        }
        
        // Updating data
        $this->userModel->update($id, $data);
        
        // Redirect to the user page
        $this->redirect(BASE_URL . "users/{$id}", $response);
    }
    
    /**
     * Delete user
     */
    public function delete(Request $request, Response $response, $params) {
        $id = $params[0];
        
        // Checking the existence of the user
        $user = $this->userModel->find($id);
        if (!$user) {
            $response->setStatusCode(404);
            echo 'User not found';
            return;
        }
        
        // Delete user
        $this->userModel->delete($id);
        
        // Redirect to the list of users
        $this->redirect(BASE_URL . 'users', $response);
    }
}