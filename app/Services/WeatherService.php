<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected string $apiKey;
    protected string $baseUrl = 'http://api.weatherapi.com/v1';

    public function __construct()
    {
        $this->apiKey = config('services.weatherapi.key');
    }

    public function getCurrentWeather(string $location): array
    {
        $response = Http::get("{$this->baseUrl}/current.json", [
            'key' => $this->apiKey,
            'q' => $location,
            'aqi' => 'no',
        ]);

        return $response->json();
    }

    public function extractIconName($url) 
    {
        $parts = explode('/', $url);
        
        $key = array_search('day', $parts);
        if ($key === false) {
            $key = array_search('night', $parts);
        }
        
        if ($key !== false && isset($parts[$key + 1])) {
            $code = pathinfo($parts[$key + 1], PATHINFO_FILENAME);
            return $parts[$key] . '/' . $code;
        }
        
        return 'day/116';
    }
}