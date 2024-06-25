<?php

namespace App\Services;

use App\Http\Client\WeatherApi;
use App\Models\WeatherDetail;

class WeatherService
{
    public function __construct(
        private readonly WeatherApi $weatherClient
    ) {
    }

    public function getWeatherDetails(string $date, string $city = 'lagos'): ?WeatherDetail
    {
        try {
            $weatherData = $this->weatherClient->getWeatherByDate($date, $city, 14);

            if ($weatherData !== null) {
                $weather = WeatherDetail::query()
                    ->create([
                        'date' => $date,
                        'city' => $city,
                    'weather_data' => json_encode($weatherData['forecast'])
                    ]);

                return $weather;
            }
        } catch (\Throwable $e) {
            logger($e);
            return null;
        }
    }
}
