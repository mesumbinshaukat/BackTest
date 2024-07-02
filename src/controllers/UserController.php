<?php
require_once '../config/config.php';

class UserController
{
    public static function createUser($username, $email, $password)
    {
        $conn = connect();
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $passwordHash);

        if ($stmt->execute()) {
            // echo json_encode(['success' => 'User created successfully']);
            echo "<script>console.log('User created successfully')</script>";
        } else {
            // echo json_encode(['error' => 'Failed to create user']);
            echo "<script>console.log('Failed to create user')</script>";
        }

        $stmt->close();
        $conn->close();
    }

    public static function loginUser($username, $password)
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
                // echo json_encode(['success' => 'Login successful']);
                echo "<script>console.log('Login successful')</script>";
            } else {
                // echo json_encode(['error' => 'Invalid password']);
                echo "<script>console.log('Invalid password')</script>";
            }
        } else {
            // echo json_encode(['error' => 'User not found']);
            echo "<script>console.log('User not found')</script>";
        }

        $stmt->close();
        $conn->close();
    }

    public static function logoutUser()
    {
        session_unset();
        session_destroy();
        // echo json_encode(['success' => 'Logout successful']);
        echo "<script>console.log('Logout successful')</script>";
    }
}
