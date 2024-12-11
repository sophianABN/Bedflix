<?php
session_start();
require_once '../config/database.php';

// URL routing basique
$page = $_GET['page'] ?? 'home';

// Headers & navigation communes
require_once '../src/includes/header.php';

// Router
switch($page) {
    case 'login':
        require_once '../src/auth/login.php';
        break;
    case 'register':
        require_once '../src/auth/register.php';
        break;
    case 'logout':
        require_once '../src/auth/logout.php';
        break;
    case 'profile':
        require_once '../src/profile/edit.php';
        break;
    default:
        require_once '../src/home.php';
}

require_once '../src/includes/footer.php';