<?php

namespace trepro\Weather;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    private $client;
    private $apiKey;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->apiKey = config('weather.api_key');
    }

    /**
     * @param string $city
     * @return array
     */
    public function getWeather(string $city, string $temperatureUnit = 'C'): array
    {
        $units = $temperatureUnit === 'C' ? 'metric' : 'imperial';
        $response = $this->client->get(config('weather.api_endpoint') . "/weather?q=$city&appid={$this->apiKey}&units=$units");
        $weatherData = json_decode($response->getBody()->getContents(), true);
        
        return [
            'temperature' => $weatherData['main']['temp'],
            'feels_like' => $weatherData['main']['feels_like'],
            'temp_min' => $weatherData['main']['temp_min'],
            'temp_max' => $weatherData['main']['temp_max'],
            'pressure' => $weatherData['main']['pressure'],
            'humidity' => $weatherData['main']['humidity'],
            'description' => $weatherData['weather'][0]['description'],
        ];
    }

    /**
     * @param string $city
     * @return array
     */
    public function getForecast(string $city, string $temperatureUnit = 'C'): array
    {
        $units = $temperatureUnit === 'C' ? 'metric' : 'imperial';
        $response = $this->client->get(config('weather.api_endpoint') . "/forecast?q=$city&appid={$this->apiKey}&units=$units");
        $forecastData = json_decode($response->getBody()->getContents(), true);
        
        $forecast = [];
        foreach ($forecastData['list'] as $day) {
            $forecast[] = [
                'dt' => $day['dt'],
                'main' => [
                    'temp' => $day['main']['temp'],
                ],
                'weather' => [
                    [
                        'description' => $day['weather'][0]['description'],
                    ],
                ],
            ];
        }
        
        return $forecast;
    }
}