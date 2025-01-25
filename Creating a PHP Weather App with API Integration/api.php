<?php
require_once "config.php";

function getWeatherData($city)
{
    $url = API_URL . "?q=$city&units=metric&appid=" . API_KEY;
    $response = file_get_contents($url);
    return json_decode($response, true);
}
