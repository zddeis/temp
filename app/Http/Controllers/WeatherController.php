<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index(Request $request)
    {
        $location = $request->query('location', 'Coimbra, Portugal');

        $response = Http::get('http://api.weatherapi.com/v1/current.json', [
            'key' => 'f66876eb00244fcc82d145809252603',
            'q' => $location,
            'aqi' => 'no'
        ]);

        $weather = $response->json();

        return view('weather', [
            'weather' => $weather,
            'location' => $location
        ]);
    }
}