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
namespace App\Models;

use Core\Model;

class User extends Model {
    protected $table = 'users';
    
    /**
     * Finds a user by email
     */
    public function findByEmail($email) {
        return $this->db->fetch("SELECT * FROM {$this->table} WHERE email = ?", [$email]);
    }
    
    /**
     * Gets all posts of a user
     */
    public function getPosts($userId) {
        return $this->db->fetchAll(
            "SELECT p.* FROM posts p
             JOIN users u ON p.user_id = u.id
             WHERE u.id = ?
             ORDER BY p.created_at DESC",
            [$userId]
        );
    }
}