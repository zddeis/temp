<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\WeatherService;

class Weather extends Component
{
    public $location = 'Coimbra, Portugal';
    public $weather;

    public function mount()
    {
        $this->fetchWeather();
    }

    public function fetchWeather()
    {
        $weatherService = app(WeatherService::class);
        $this->weather = $weatherService->getCurrentWeather($this->location);
    }

    public function render()
    {
        return view('livewire.weather')->layout('Components.layout');
    }
}