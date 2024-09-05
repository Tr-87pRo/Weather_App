<?php

namespace trepro\Inspire;

use Illuminate\Support\Facades\Http;
use Exception;

class Inspire {
    public function justDoIt() {
        try {
            $output = '';

            for ($i = 0; $i < 5; $i++) {
                $response = Http::get('https://api.quotable.io/random');

                $data = $response->json();

                if (!$data || !isset($data['content'], $data['author'])) {
                    throw new Exception('Invalid API response');
                }

                $quote = $data['content'];
                $author = $data['author'];

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