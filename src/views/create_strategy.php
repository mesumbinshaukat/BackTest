<!-- src/views/create_strategy.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Strategy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Create Strategy</h1>
        </div>
        <div class="navbar">
            <a href="?action=home">Home</a>
            <a href="?action=login">Login</a>
            <a href="?action=signup">Sign Up</a>
            <a href="?action=create_strategy">Create Strategy</a>
        </div>
        <div class="content">
            <form action="/public/api.php?action=create_strategy" method="POST">
                <label for="name">Strategy Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
                <label for="settings">Settings (JSON):</label>
                <textarea id="settings" name="settings" required></textarea>
                <button type="submit">Create Strategy</button>
            </form>
        </div>
    </div>
</body>

</html>