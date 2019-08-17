<?php

namespace App\Http\Controllers;

use App\Service\YandexWeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function index(YandexWeatherService $weatherService)
    {
        $weather = $weatherService->getFactWeather();

        return view('weather.index', compact('weather'));
    }
}
