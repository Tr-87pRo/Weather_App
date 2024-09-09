<?php

namespace trepro\Weather\Controllers;

use trepro\weather\WeatherService;
use App\Http\Controllers\Controller as BaseController; 

class WeatherController extends BaseController { 
    private $weatherService;

    public function __construct(WeatherService $weatherService) {
        $this->weatherService = $weatherService;
    }
    public function index() {
        $city = 'London'; 
        $weatherData = $this->weatherService->getWeather($city);
        $temperatureUnit = 'C'; 
        $humidity = $weatherData['humidity'] ?? null; 
        $weatherData['humidity'] = $humidity; // Ensure the 'humidity' key is always present
        $weatherCondition = $weatherData['weatherCondition'] ?? null; 
        $weatherData['weatherCondition'] = $weatherCondition; // Ensure the 'weatherCondition' key is always present
        $temperature = $weatherData['temperature'] ?? null; 
        $weatherData['temperature'] = $temperature; // Ensure the 'temperature' key is always present
        return view('weather::weather', [
            'city' => $city,
            'weatherData' => $weatherData,
            'temperatureUnit' => $temperatureUnit, 
        ]);
    }
}