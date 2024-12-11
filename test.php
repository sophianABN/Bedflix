<?php
require_once 'config/database.php';

try {
    $db = Database::getInstance();
    echo "Connexion réussie à la base de données !";
    
    // Test supplémentaire - vérifions si nous pouvons lister les tables
    $query = $db->query("SHOW TABLES");
    $tables = $query->fetchAll(PDO::FETCH_COLUMN);
    
    echo "\n\nListe des tables :";
    if (empty($tables)) {
        echo "\nAucune table trouvée.";
    } else {
        foreach ($tables as $table) {
            echo "\n- " . $table;
        }
    }
    
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}