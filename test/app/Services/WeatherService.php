<?php

namespace app\services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {

        $this->apiKey = 'f213b857d10d098f070164cc55796a40';
        $this->baseUrl ='https://api.openweathermap.org/data/2.5/weather';
    }

    public function getWeatherByCity($city)
    {
        return Cache::remember("weather_{$city}", 3600, function () use ($city) {
            $response = Http::withoutVerifying()->get($this->baseUrl, [
                'q' => "{$city},ua",
                'appid' => $this->apiKey,
                'units' => 'metric',
                'lang' => 'ru'
            ]);


            if ($response->successful()) {
                return $response->json();
            }
            return null;
        });
    }
}
