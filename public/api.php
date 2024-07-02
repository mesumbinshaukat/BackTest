<?php
session_start();

require_once '../config/config.php';
require_once '../src/controllers/UserController.php';
require_once '../src/controllers/StrategyController.php';

$action = $_GET['action'] ?? null;

// header('Content-Type: application/json');

switch ($action) {
    case 'create_user':
        UserController::createUser($_POST['username'], $_POST['email'], $_POST['password']);
        break;
    case 'login':
        UserController::loginUser($_POST['username'], $_POST['password']);
        break;
    case 'create_strategy':
        if (isset($_SESSION['user_id'])) {
            StrategyController::createStrategy($_SESSION['user_id'], $_POST['name'], $_POST['description'], $_POST['settings']);
        } else {
            echo json_encode(['error' => 'User not logged in']);
        }
        break;
    case 'get_strategies':
        if (isset($_SESSION['user_id'])) {
            StrategyController::getStrategies($_SESSION['user_id']);
        } else {
            echo json_encode(['error' => 'User not logged in']);
        }
        break;
    case 'backtest':
        StrategyController::performBacktest($_POST['strategy_id']);
        break;
    case 'logout':
        UserController::logoutUser();;
        break;
    default:
        echo json_encode(['error' => 'Invalid API action']);
        break;
}
