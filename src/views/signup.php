<!-- src/views/signup.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Sign Up</h1>
        </div>
        <div class="navbar">
            <a href="?action=home">Home</a>
            <a href="?action=login">Login</a>
            <a href="?action=signup">Sign Up</a>
        </div>
        <div class="content">
            <form action="/backtest/public/api.php?action=create_user" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Sign Up</button>
            </form>
        </div>
    </div>
</body>

</html>