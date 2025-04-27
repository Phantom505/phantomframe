# PhantomFrame - is a simple and lightweight PHP micro-framework

PhantomFrame is a simple and lightweight PHP micro-framework that demonstrates a solid understanding of MVC architecture, routing, and database interaction. It is designed for developers who need a straightforward, efficient solution for building modern web applications

## Features

- MVC (Model-View-Controller) architecture
- Flexible routing system
- Database interaction via PDO
- Class autoloading
- Error handling
- Simple templating engine

## Directory structure

```
/app/                - main application code
  /Controllers/      - controllers
  /Models/           - models
  /Views/            - performances
/config/             - configuration files
/core/               - framework core
/public/             - public files (CSS, JS, etc.)
index.php            - entry point
```

## Installation

1. Clone the repository
```bash
git clone https://github.com/phantom505/phantomframe.git
```
2. Copy `config/config.example.php` to `config/config.php` and configure the database connection settings

3. Create a database and import the sample schema from `database/schema.sql`

## Setting up a database

Open the `config/config.php` file and configure the database connection settings:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'phantomframe');
define('DB_USER', 'phantom');
define('DB_PASS', '');
```

## Routing

Routes are defined in the `config/routes.php` file. Example of adding routes:

```php
// Home page
$router->get('/', 'HomeController@index');

// Routes for users
$router->get('/users', 'UserController@index');
$router->get('/users/{id}', 'UserController@show');
$router->post('/users', 'UserController@store');
$router->post('/users/{id}', 'UserController@update');
$router->post('/users/{id}/delete', 'UserController@delete');

// Static pages
$router->get('/about', function($request, $response) {
    $view = new \Core\View();
    $html = $view->render('pages/about');
    $response->setContent($html);
    $response->send();
});
```

## Creating a controller

Controllers are located in the `app/Controllers` directory and must inherit from the `Core\Controller` base class:

```php
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
    
    public function index(Request $request, Response $response) {
        $users = $this->userModel->all();
        
        $this->render('users/index', [
            'title' => 'Users',
            'users' => $users
        ], $response);
    }
}
```

## Creating a model

Models are located in the `app/Models` directory and must inherit from the `Core\Model` base class:

```php
namespace App\Models;

use Core\Model;

class User extends Model {
    protected $table = 'users';
    
    public function findByEmail($email) {
        return $this->db->fetch("SELECT * FROM {$this->table} WHERE email = ?", [$email]);
    }
}
```

## Creating a view

Views are located in the `app/Views` directory and contain HTML code with PHP inserts:

```php
<?php
$yield = <<<HTML
    <h2>{$title}</h2>
    <p>{$content}</p>
HTML;

include __DIR__ . '/../layout.php';
?>
```

## Working with the database

To work with the database, the `Core\Database` class is used with an abstraction over PDO:

```php
// Get all records
$users = $this->db->fetchAll("SELECT * FROM users");

// Get one record
$user = $this->db->fetch("SELECT * FROM users WHERE id = ?", [$id]);

// Adding a record
$id = $this->db->insert('users', [
    'name' => 'Иван',
    'email' => 'ivan@example.com',
    'password' => password_hash('password', PASSWORD_DEFAULT)
]);

// Update record
$rowCount = $this->db->update('users', 
    ['name' => 'Imran'], 
    "id = ?", 
    [$id]
);

// Delete record
$rowCount = $this->db->delete('users', "id = ?", [$id]);
```

## Error handling

The framework includes basic error handling:

```php
try {
    // Code that may cause an error
} catch (\Exception $e) {
    $response->setStatusCode(500);
    echo 'Error: ' . $e->getMessage();
}
```

## License

MIT