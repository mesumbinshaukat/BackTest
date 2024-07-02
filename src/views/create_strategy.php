<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Strategy</title>
    <link rel="stylesheet" href="/backtest/assets/css/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Create Strategy</h1>
        </div>
        <?php include 'navbar.php'; ?>
        <div class="content">
            <form action="/backtest/public/api.php?action=create_strategy" method="POST">
                <label for="name">Strategy Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
                <label for="settings">Settings:</label>
                <textarea id="settings" name="settings" required></textarea>
                <button type="submit">Create Strategy</button>
            </form>
        </div>
    </div>
</body>

</html>