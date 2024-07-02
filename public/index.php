<?php
session_start();
$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        include '../src/views/home.php';
        break;
    case 'login':
        include '../src/views/login.php';
        break;
    case 'signup':
        include '../src/views/signup.php';
        break;
    case 'create_strategy':
        include '../src/views/create_strategy.php';
        break;
    case 'view_strategies':
        include '../src/views/strategies.php';
        break;
    default:
        include '../src/views/home.php';
        break;
}
