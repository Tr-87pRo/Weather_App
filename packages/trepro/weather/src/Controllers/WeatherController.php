<?php

namespace trepro\Weather\Controllers;

use trepro\Weather\Currency as CurrencyModel;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use trepro\Weather\WeatherService;

class WeatherController extends BaseController 
{
    private $weatherService;
    
    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }
    
    public function index(Request $request)
    {
        $city = $request->input('city', 'London'); 
        $temperatureUnit = $request->input('temperatureUnit', 'C');
    
        $weatherData = $this->weatherService->getWeather($city, $temperatureUnit);
        $requiredKeys = ['temperature', 'feels_like', 'temp_min', 'temp_max', 'pressure', 'humidity', 'description'];
    
        foreach ($requiredKeys as $key) {
            $weatherData[$key] = $weatherData[$key] ?? null;
        }
    
        $forecastData = $this->weatherService->getForecast($city, $temperatureUnit);
      
       // $currencies = CurrencyModel::all();
    
        return view('weather::weather', [
            'city' => $city,
            'weatherData' => $weatherData,
            'temperatureUnit' => $temperatureUnit,
            'error' => null,
            'forecastData' => $forecastData,
         //   'currencies' => $currencies,
        ]);
    }
}