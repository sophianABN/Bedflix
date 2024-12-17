<?php
namespace Core;

use PDO;

abstract class Model {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findById($id) {
        $table = $this->getTable();
        $stmt = $this->db->prepare("SELECT * FROM {$table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findAll() {
        $table = $this->getTable();
        $stmt = $this->db->prepare("SELECT * FROM {$table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getTable() {
        // Convertit "FilmModel" en "FILMS"
        $className = (new \ReflectionClass($this))->getShortName();
        $tableName = str_replace('Model', '', $className);
        return strtoupper($tableName) . 'S';
    }
} 