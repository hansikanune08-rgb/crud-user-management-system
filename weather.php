<?php
$city = "Hyderabad";   // You can change this to any city
$apiKey = "f2c04fccb9e7808f8b3de6a127a9dc19";

$url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric";

$response = file_get_contents($url);

$data = json_decode($response, true);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Weather Information</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>Current Weather</h2>

<?php
if ($data && $data["cod"] == 200) {
    echo "<p><strong>City:</strong> " . $data["name"] . "</p>";
    echo "<p><strong>Temperature:</strong> " . $data["main"]["temp"] . " °C</p>";
    echo "<p><strong>Weather:</strong> " . $data["weather"][0]["description"] . "</p>";
    echo "<p><strong>Humidity:</strong> " . $data["main"]["humidity"] . "%</p>";
} else {
    echo "<p>Unable to fetch weather data.</p>";
}
?>

</div>

</body>
</html>