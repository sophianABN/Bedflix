<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

class Database {
    private static $instance = null;
    
    public static function getInstance() {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    'mysql:host=' . $_ENV['DB_HOST'] . 
                    ';dbname=' . $_ENV['DB_NAME'] . 
                    ';charset=utf8',
                    $_ENV['DB_USER'],
                    $_ENV['DB_PASS'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch(PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}