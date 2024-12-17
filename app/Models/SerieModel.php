<?php
namespace App\Models;

use Core\Model;
use PDO;

class SerieModel extends Model {
    public function getRecent($limit = 6) {
        $stmt = $this->db->prepare("
            SELECT * 
            FROM SERIES 
            ORDER BY id_serie DESC 
            LIMIT :limit
        ");
        
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} 