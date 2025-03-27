<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function index(Request $request)
    {
        $weatherService = app(WeatherService::class);
        $location = $request->query('location', 'Coimbra, Portugal');
        $weather = $weatherService->getCurrentWeather($location);
        
        return view('weather', [
            'weather' => $weather,
            'location' => $location,
        ]);
    }
}