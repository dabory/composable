<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class OpenAiController extends Controller
{
    public function getCompletion(Request $request)
    {
        $apiKey = env('OPENAI_API_KEY');
        $userMessage = $request->input('message');

        if (empty($userMessage)) {
            return response()->json(['error' => 'Message is required'], 400);
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Content-Type' => 'application/json'
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $userMessage
                    ]
                ],
                'max_tokens' => 1200,
            ]);

            $data = $response->json();
            $text = isset($data['choices'][0]['message']['content']) ? $data['choices'][0]['message']['content'] : 'No response text found';
            // $text = $data;
            // dd($text);
            return response()->json(['text' => $text]);
        } catch (\Exception $e) {
            \Log::error('OpenAI API request failed', ['exception' => $e]);
            return response()->json(['error' => 'OpenAI API request failed'], 500);
        }
    }

}
