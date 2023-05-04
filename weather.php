<?php

// OpenWeather API endpoint and parameters
$apiEndpoint = 'https://api.openweathermap.org/data/2.5/forecast';
$apiKey = 'b85c73a205ea8927234a1a985ab54b7f'; // Replace with your actual API key
$location = 'Bangladesh';
$days = 15;

// Construct the API URL
$url = "{$apiEndpoint}?q={$location}&appid={$apiKey}";

// Make the API request and get the response
$response = file_get_contents($url);

// Check if API request was successful
if ($response === FALSE) {
    echo "Failed to fetch weather data.";
} else {
    // Decode the JSON response
    $data = json_decode($response, TRUE);

    // Check if the response contains weather data
    if (isset($data['list']) && count($data['list']) > 0) {
        // Output the weather data
        echo "<h1>Weather in Bangladesh for the next {$days} days:</h1>";
        echo "<ul>";
        foreach ($data['list'] as $item) {
            $date = date('Y-m-d', $item['dt']);
            $weather = $item['weather'][0]['description'];
            $temp = $item['main']['temp'];
            echo "<li>{$date}: {$weather}, Temperature: {$temp} &deg;C</li>";
        }
        echo "</ul>";
    } else {
        echo "No weather data available.";
    }
}

?>
