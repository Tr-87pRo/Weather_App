<?php

namespace trepro\Inspire;

use Illuminate\Support\Facades\Http;

class Inspire {
    public function justDoIt() {
        $response = Http::get('https://zenquotes.io/api/random');

        dd($response->json());

        return $response['quote'] . ' -' . $response['author'];
    }
}