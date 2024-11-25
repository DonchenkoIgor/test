<?php

namespace Tests\Feature;

use App\Services\WeatherService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_by_city(): void
    {

        $city = 'Kyiv';
        $mockResponse = [
            'weather' => [['description' => 'clear sky']],
            'main'    => ['temp' => 15],
        ];

        Http::fake([
            'https://api.openweathermap.org/*' => Http::response($mockResponse, 200),
        ]);

        Cache::shouldReceive('remember')
            ->once()
            ->with("weather_{$city}", 3600, \Closure::class)
            ->andReturn($mockResponse);

        $weatherService = new WeatherService();

        $response = $weatherService->getWeatherByCity($city);

        $this->assertEquals($mockResponse, $response);
    }

    public function test_get_weather_by_city_handles_error(): void
    {
        $city = 'Kyiv';

        Http::fake([
            'https://api.openweathermap.org/*' => Http::response([], 404),
        ]);

        Cache::shouldReceive('remember')
            ->once()
            ->with("weather_{$city}", 3600, \Closure::class)
            ->andReturn(null);

        $weatherService = new WeatherService();

        $response = $weatherService->getWeatherByCity($city);

        $this->assertNull($response);
    }
}
