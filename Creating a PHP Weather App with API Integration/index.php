<?php
require_once "api.php";

$weather = null;
$error = null;

if (isset($_POST["city"])) {
    $city = $_POST["city"];
    $weather = getWeatherData($city);

    if (isset($weather["cod"]) && $weather["cod"] == 200) {
        $temperature = $weather["main"]["temp"];
        $description = $weather["weather"][0]["description"];
    } else {
        $error = "City not found. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Weather App</h1>
        <form method="POST">
            <input type="text" name="city" placeholder="Enter city name" required>
            <button type="submit">Get Weather</button>
        </form>

        <?php if ($weather && !$error): ?>
            <div class="weather-info">
                <h2>Weather in <?php echo $city; ?></h2>
                <p>Temperature: <?php echo $temperature; ?>°C</p>
                <p>Description: <?php echo $description; ?></p>
            </div>
        <?php elseif ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
