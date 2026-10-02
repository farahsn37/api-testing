<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ExternalApiController extends Controller
{
    public function posts()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        return $response->json();
    }
}
