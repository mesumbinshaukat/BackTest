<?php
require_once '../config/config.php';

$action = $_GET['action'] ?? null;

header('Content-Type: application/json');

function createUser($username, $email, $password)
{
    $conn = connect();
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $passwordHash);

    if ($stmt->execute()) {
        echo json_encode(['success' => 'User created successfully']);
    } else {
        echo json_encode(['error' => 'Failed to create user']);
    }

    $stmt->close();
    $conn->close();
}

function loginUser($username, $password)
{
    $conn = connect();

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $passwordHash);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $passwordHash)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            echo json_encode(['success' => 'Login successful']);
        } else {
            echo json_encode(['error' => 'Invalid password']);
        }
    } else {
        echo json_encode(['error' => 'User not found']);
    }

    $stmt->close();
    $conn->close();
}

function createStrategy($userId, $name, $description, $settings)
{
    $conn = connect();

    $stmt = $conn->prepare("INSERT INTO strategies (user_id, name, description, settings) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $userId, $name, $description, $settings);

    if ($stmt->execute()) {
        echo json_encode(['success' => 'Strategy created successfully']);
    } else {
        echo json_encode(['error' => 'Failed to create strategy']);
    }

    $stmt->close();
    $conn->close();
}

function getStrategies($userId)
{
    $conn = connect();

    $stmt = $conn->prepare("SELECT id, name, description, settings FROM strategies WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $strategies = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode(['strategies' => $strategies]);

    $stmt->close();
    $conn->close();
}

function performBacktest($strategyId)
{
    // Placeholder for backtesting logic
    // Fetch historical data and apply strategy settings
    $result = [
        'success' => true,
        'data' => 'Backtesting results here'
    ];

    echo json_encode($result);
}

// Existing switch cases...

switch ($action) {
    case 'create_user':
        createUser($_POST['username'], $_POST['email'], $_POST['password']);
        break;
    case 'login':
        loginUser($_POST['username'], $_POST['password']);
        break;
    case 'create_strategy':
        createStrategy($_SESSION['user_id'], $_POST['name'], $_POST['description'], $_POST['settings']);
        break;
    case 'get_strategies':
        getStrategies($_SESSION['user_id']);
        break;
    case 'backtest':
        performBacktest($_POST['strategy_id']);
        break;
    default:
        echo json_encode(['error' => 'Invalid API action']);
        break;
}