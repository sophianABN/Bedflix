<?php
namespace Core;

abstract class Controller {
    protected function view($name, $data = []) {
        extract($data);
        require_once "../app/Views/layouts/header.php";
        require_once "../app/Views/{$name}.php";
        require_once "../app/Views/layouts/footer.php";
    }

    protected function redirect($url) {
        header("Location: $url");
        exit;
    }
} 