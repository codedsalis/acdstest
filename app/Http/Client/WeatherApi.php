<?php

namespace App\Http\Client;

use Illuminate\Http\Client\PendingRequest;

class WeatherApi extends PendingRequest
{
    public function getWeatherByDate(?string $date = null, string $city, ?int $days = null)
    {
        $response = $this->get(config('services.weather_api.base_url') . '/forecast.json', [
            'dt' => $date ?? null,
            'key' => config('services.weather_api.secret_key'),
            'q' => $city,
            'days' => $days ?? null
        ]);

        if ($response->failed()) {
            $response->throw();
        }

        return $response->json();
    }
}
