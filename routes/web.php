<?php
use Core\Router;

$router = Router::getInstance();

// Routes d'authentification
$router->add('GET', '/login', 'AuthController', 'login');
$router->add('POST', '/login', 'AuthController', 'login');
$router->add('GET', '/register', 'AuthController', 'register');
$router->add('POST', '/register', 'AuthController', 'register');
$router->add('GET', '/logout', 'AuthController', 'logout');

// Routes principales
$router->add('GET', '/', 'HomeController', 'index');
$router->add('GET', '/profile', 'ProfileController', 'edit');
$router->add('POST', '/profile', 'ProfileController', 'update');