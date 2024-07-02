<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Strategies</title>
    <link rel="stylesheet" href="/backtest/assets/css/style.css">
    <script>
        function fetchStrategies() {
            fetch('/backtest/public/api.php?action=get_strategies')
                .then(response => response.json())
                .then(data => {
                    const strategiesList = document.getElementById('strategies-list');
                    strategiesList.innerHTML = '';
                    data.strategies.forEach(strategy => {
                        const li = document.createElement('li');
                        li.textContent = `${strategy.name}: ${strategy.description}`;
                        strategiesList.appendChild(li);
                    });
                });
        }

        window.onload = fetchStrategies;
    </script>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>My Strategies</h1>
        </div>
        <?php include 'navbar.php'; ?>
        <div class="content">
            <ul id="strategies-list">
                <!-- Strategies will be loaded here by JavaScript -->
            </ul>
        </div>
    </div>
</body>

</html>