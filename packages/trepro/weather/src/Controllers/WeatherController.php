<?php

namespace trepro\Weather\Controllers;

use trepro\weather\WeatherService;
use App\Http\Controllers\Controller;

class WeatherController extends Controller {
    private $weatherService;

    public function __construct() {
        $this->weatherService = new WeatherService;
    }

    public function index() {
        $city = 'London'; 
        $weatherData = $this->weatherService->getWeather($city);
        return view('weather::weather', [
            'city' => $city,
            'weatherData' => $weatherData,
        ]);
    }
}