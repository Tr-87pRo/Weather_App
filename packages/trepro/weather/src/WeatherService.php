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
    public function getWeather(string $city): array
    {
        if ($city !== 'London') {
            throw new \InvalidArgumentException('Only London is supported');
        }

        try {
            $response = $this->client->get("http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$this->apiKey");
            $weatherData = json_decode($response->getBody()->getContents(), true);
            return $weatherData;
        }   catch (\Exception $e) {
            Log::error("Error fetching weather data: " . $e->getMessage());
            throw new \Exception("Unable to retrieve weather data: " . $e->getMessage());
        }
    }
}