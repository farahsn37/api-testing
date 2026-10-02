<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function current(Request $request)
    {
        $city = $request->query('city');

        $locationResponse = Http::get(
            'https://geocoding-api.open-meteo.com/v1/search',
            [
                'name' => $city,
                'count' => 1,
                'language' => 'en',
                'format' => 'json',
            ]
        );

        $location = $locationResponse->json();

        if (empty($location['results'])) {
            return response()->json([
                'message' => 'Location not found',
            ], 404);
        }

        $latitude = $location['results'][0]['latitude'];
        $longitude = $location['results'][0]['longitude'];

        $weatherResponse = Http::get(
            'https://api.open-meteo.com/v1/forecast',
            [
                'latitude' => $latitude,
                'longitude' => $longitude,
                'current' => 'temperature_2m,relative_humidity_2m,weather_code,wind_speed_10m',
            ]
        );

        return $weatherResponse->json();
    }
}
