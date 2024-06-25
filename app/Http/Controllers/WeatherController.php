<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherRequest;
use App\Services\WeatherService;
use Inertia\Inertia;

class WeatherController extends Controller
{
    public function __construct(
        public readonly WeatherService $weatherService
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function showWeather(WeatherRequest $request)
    {
        $validated = $request->validated();

        $city = $validated['city'] ?? 'lagos';

        $weather = $this->weatherService->getWeatherDetails($validated['date'] ?? date('Y-M-d'), $city);

        if ($weather === null) {
            return Inertia::render('Weather/Show', [
                'weather' => null
            ]);
        }

        return Inertia::render('Weather/Show', [
            'weather' => $weather
        ]);
    }
}
