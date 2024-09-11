<?php

namespace trepro\Weather\Controllers;

use trepro\weather\WeatherService;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request; 

class WeatherController extends BaseController { 
    private $weatherService;

    public function __construct(WeatherService $weatherService) {
        $this->weatherService = $weatherService;
    }
    public function index(Request $request)
    {
        $city = 'London'; 
        $temperatureUnit = $request->input('temperatureUnit', 'C'); 
        $weatherData = $this->weatherService->getWeather($city, $temperatureUnit);
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