<?php
session_start();
require_once '../vendor/autoload.php';

// Chargement des variables d'environnement
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

use Core\Router;

// Chargement des routes
require_once '../routes/web.php';

// Dispatch de la requête
Router::getInstance()->dispatch();