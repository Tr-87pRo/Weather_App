<?php

namespace trepro\Weather;

use Illuminate\Support\Facades\Http;
use Exception;

class Weather {
    public function getWeather($city) {
        try {
            $apiKey = 'YOUR_OPENWEATHERMAP_API_KEY'; // replace with your OpenWeatherMap API key
            $response = Http::get("http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric");

            $data = $response->json();

            if (!$data || !isset($data['main'], $data['weather'])) {
                throw new Exception('Invalid API response');
            }

            $temperature = $data['main']['temp'];
            $humidity = $data['main']['humidity'];
            $weatherCondition = $data['weather'][0]['description'];

            $output = "<h2>Current Weather in $city</h2>";
            $output .= "<p>Temperature: {$temperature}°C</p>";
            $output .= "<p>Humidity: $humidity%</p>";
            $output .= "<p>Weather Condition: $weatherCondition</p>";

            return $output;
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
