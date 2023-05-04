<?php

// OpenWeather API endpoint and parameters
$apiEndpoint = 'https://api.openweathermap.org/data/2.5/forecast';
$apiKey = 'b85c73a205ea8927234a1a985ab54b7f'; // Replace with your actual API key
$location = 'Bangladesh';
$days = 15;
$unites='metric';
// Construct the API URL
$url = "{$apiEndpoint}?q={$location}&appid={$apiKey}&units={$unites}";

// Make the API request and get the response
$response = file_get_contents($url);

// Check if API request was successful
if ($response === FALSE) {
    echo "Failed to fetch weather data.";
} else {
    // Decode the JSON response
    $data = json_decode($response, TRUE);

    // Check if the response contains weather data
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>
<body>
<section class="vh-100" style="background-color: #f5f6f7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
          <?php
          if (isset($data['list']) && count($data['list']) > 0) {
            // Output the weather data
            foreach ($data['list'] as $item) {
                $date = date('Y-m-d', $item['dt']);
                $weather = $item['weather'][0]['description'];
                $temp = $item['main']['temp'];
                $feels_like = $item['main']['feels_like'];
                ob_start();
                ?>


      <div class="col-md-10 col-lg-8 col-xl-6 my-2">
        <div class="card text-white" style="border-radius: 40px;">
          <div class="bg-image" style="border-radius: 35px;">
            <img src="draw1.webp"
              class="card-img" alt="weather" />
            <div class="mask" style="background-color: rgba(190, 216, 232, .5);"></div>
          </div>
                        <div class="card-img-overlay text-dark p-5">
                            <h4 class="mb-0"><?= $date ?></h4>
                            <p class="display-2 my-3"><?=$temp?></p>
                            <p class="mb-2">Feels Like: <strong><?=$feels_like?></strong></p>
                            <h5><?=$weather?></h5>
                        </div>

        </div>

      </div>
                <?php
                $html= ob_get_clean();
                echo $html;
            }
        } else {
            echo "No weather data available.";
        }
        ?>

    </div>
  </div>
</section>
</body>
</html>