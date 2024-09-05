<?php

namespace trepro\Inspire;

use Illuminate\Support\Facades\Http;
use Exception;

class Inspire {
    public function justDoIt() {
        try {
            $output = '';

            for ($i = 0; $i < 5; $i++) {
                $response = Http::get('https://zenquotes.io/api/random');

                $data = $response->json();

                if (!$data || !isset($data[0]['q'], $data[0]['a'])) {
                    throw new Exception('Invalid API response');
                }

                $quote = $data[0]['q'];
                $author = $data[0]['a'];

                $output .= "<blockquote style='background-color: #f9f9f9; padding: 20px; border-left: 5px solid #ccc;'>";
                $output .= "<p>$quote</p>";
                $output .= "<cite>$author</cite>";
                $output .= "</blockquote><br>"; 
            }

            return $output;
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}