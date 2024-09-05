<?php

namespace trepro\weather;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    private $client;
    private $apiKey;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->apiKey = env('bd8bd51f8afa4db3e68e48e44a22d72d');
    }

    public function getWeather($city)
    {
        try {
            $response = $this->client->get("http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$this->apiKey");
            $weatherData = json_decode($response->getBody()->getContents(), true);
            return $weatherData;
        } catch (\Exception $e) {
            Log::error("Error fetching weather data: " . $e->getMessage());
            throw new \Exception("Unable to retrieve weather data: " . $e->getMessage());
        }
    }
}