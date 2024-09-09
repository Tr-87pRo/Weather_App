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
        $requiredKeys = ['humidity', 'weatherCondition', 'temperature'];
    
        foreach ($requiredKeys as $key) {
            $weatherData[$key] = $weatherData[$key] ?? null;
        }
    
        return view('weather::weather', [
            'city' => $city,
            'weatherData' => $weatherData,
            'temperatureUnit' => $temperatureUnit, 
        ]);
    }
}