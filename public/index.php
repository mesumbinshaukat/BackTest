<?php
require_once '../config/config.php';

session_start();

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        require '../src/views/home.php';
        break;
    case 'login':
        require '../src/views/login.php';
        break;
    case 'signup':
        require '../src/views/signup.php';
        break;
    default:
        require '../src/views/404.php';
        break;
}
?>