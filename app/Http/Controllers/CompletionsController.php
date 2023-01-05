<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class CompletionsController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'prompt' => 'required',
            // 'model' => 'required',
            // 'max_tokens' => 'required|integer',
        ]);

        // Set up the API request parameters
        $prompt = $request->input('prompt');
        // $model = $request->input('model');
        // $maxTokens = $request->input('max_tokens');
        // $apiKey = config('services.openai.secret');

        // Make the API request
        // $response = Http::withHeaders([
        //     'Content-Type' => 'application/json',
        //     'Authorization' => "Bearer $apiKey"
        // ])->post('https://api.openai.com/v1/completions', [
        //     'prompt' => $prompt,
        //     'model' => $model,
        //     'max_tokens' => $maxTokens,
        // ]);


        $result = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $prompt,
            'max_tokens' => 2000,
        ]);
        $completions = $result['choices'];

        return view('completions.show', ['completions' => $completions, 'prompt' => $prompt]);

        // echo $result['choices'][0]['text']; // an open-source, widely-used, server-side scripting language.
        // echo $result['choices'][0]['text']; // an open-source, widely-used, server-side scripting language.
        //
        // // Check for success
        // if ($response->successful()) {
        //     // Parse the response and return it to the user
        //     $completions = $response->json()['choices'];
        //     return view('completions.show', ['completions' => $completions]);
        // } else {
        //     // Return an error message to the user
        //     return view('errors.429', ['message' => 'There was an error completing the prompt.']);
        // }
    }
}
