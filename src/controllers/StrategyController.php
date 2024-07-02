<?php
require_once '../config/config.php';

class StrategyController
{
    public static function createStrategy($userId, $name, $description, $settings)
    {
        $conn = connect();

        $stmt = $conn->prepare("INSERT INTO `strategies` (`user_id`, `name`, `description`, `settings`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $userId, $name, $description, $settings);

        if ($stmt->execute()) {
            // echo json_encode(['success' => 'Strategy created successfully']);
            echo "<script>console.log('Strategy created successfully')</script>";
        } else {
            // echo json_encode(['error' => 'Failed to create strategy', 'details' => $stmt->error]);
            echo "<script>console.log('ID: " . $userId . "')</script>";
            echo "<script>console.log('Name: " . $name . "')</script>";
            echo "<script>console.log('Description: " . $description . "')</script>";
            echo "<script>console.log('Settings: " . $settings . "')</script>";
            echo "<script>console.log('Failed to create strategy')</script>";
        }

        $stmt->close();
        $conn->close();
    }


    public static function getStrategies($userId)
    {
        $conn = connect();

        $stmt = $conn->prepare("SELECT id, name, description, settings FROM strategies WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $strategies = $result->fetch_all(MYSQLI_ASSOC);

        // echo json_encode(['strategies' => $strategies]);
        echo "<script>console.log('Strategy: " . $strategies . "')</script>";

        $stmt->close();
        $conn->close();
    }

    public static function performBacktest($strategyId)
    {
        // Placeholder for backtesting logic
        // Fetch historical data and apply strategy settings
        $result = [
            'success' => true,
            'data' => 'Backtesting results here'
        ];

        echo json_encode($result);
    }
}
