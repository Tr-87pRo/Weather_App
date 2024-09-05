<?php

namespace trepro\Weather\Controllers;

use App\Http\Controllers\Controller;
use App\Services\WeatherService;

class WeatherController extends Controller {
    public function index(WeatherService $weatherService) {
        $city = 'London'; 
        $weatherData = $weatherService->getWeather($city);
        return view('weather', ['weatherData' => $weatherData]);
    }
}