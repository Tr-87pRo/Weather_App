<?php

namespace trepro\Weather\Controllers;

use trepro\weather\WeatherService;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use trepro\weather\src\Currency as CurrencyModel;

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
    
      
        $currencies = CurrencyModel::all();
    
        return view('weather::weather', [
            'city' => $city,
            'weatherData' => $weatherData,
            'temperatureUnit' => $temperatureUnit,
            'error' => null,
            'currencies' => $currencies,
        ]);
    }
}