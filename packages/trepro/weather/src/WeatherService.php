<?php

// namespace trepro\Weather;

// use GuzzleHttp\Client;
// use Illuminate\Support\Facades\Log;

// class WeatherService
// {
//     private $client;
//     private $apiKey;

//     public function __construct(Client $client)
//     {
//         //$this->client = $client;
//         //$this->apiKey = config('OPENWEATHERMAP_API_KEY');
//     }

//     /**
//      * @param string $city
//      * @return array
//      */
//     public function getWeather(string $city): array
//     {
//         //if ($city !== 'London') {
//         //    throw new \InvalidArgumentException('Only London is supported');
//         //}

//         //try {
//         //    $response = $this->client->get("http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$this->apiKey");
//         //    $weatherData = json_decode($response->getBody()->getContents(), true);
//         //    return $weatherData;
//         //} catch (\Exception $e) {
//         //    Log::error("Error fetching weather data: " . $e->getMessage());
//         //    throw new \Exception("Unable to retrieve weather data: " . $e->getMessage());
//         //}
//     }
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
        try {
            $response = $this->client->get(config('weather.api_endpoint') . "/weather?q=$city&appid={$this->apiKey}&units=" . config('weather.units'));
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
        } catch (\Exception $e) {
            Log::error("Error fetching weather data: " . $e->getMessage());
            throw new \Exception("Unable to retrieve weather data: " . $e->getMessage());
        }
    }
}