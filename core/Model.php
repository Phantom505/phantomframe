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
 * Base class for models
 */
abstract class Model {
    protected $db;
    protected $table;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    /**
     * Finds a record by ID
     */
    public function find($id) {
        return $this->db->fetch("SELECT * FROM {$this->table} WHERE id = ?", [$id]);
    }
    
    /**
     * Returns all records
     */
    public function all() {
        return $this->db->fetchAll("SELECT * FROM {$this->table}");
    }
    
    /**
     * Creates a new entry
     */
    public function create($data) {
        return $this->db->insert($this->table, $data);
    }
    
    /**
     * Updates the entry
     */
    public function update($id, $data) {
        return $this->db->update($this->table, $data, "id = ?", [$id]);
    }
    
    /**
     * Deletes the entry
     */
    public function delete($id) {
        return $this->db->delete($this->table, "id = ?", [$id]);
    }
}