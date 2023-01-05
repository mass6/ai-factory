<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ImagesController extends Controller
{
    public function index(Request $request)
    {
        $response = OpenAI::files()->list();

        $logData = [];
        foreach ($response->data as $result) {
            $logData[] = ['id' => $result->id, 'result' => $result->object];
        }
        logger()->info('files', $logData);

    }

    public function create()
    {
        session()->reflash();

        return view('images.create');
    }

    public function store(Request $request)
    {
        $prompt = $request->input('prompt');
        $quantity = (int) $request->input('quantity', 1);
        $response = OpenAI::images()->create([
            'prompt' => $prompt,
            'model' => 'image-alpha-001',
            'size' => '1024x1024',
            'n' => $quantity,
        ]);

        $imageUrls = collect($response->data)->map(fn ($item) => $item->url)->toArray();
        logger()->info('images', ['prompt' => $prompt, 'urls' => $imageUrls]);
        session()->flash('prompt', $prompt);

        return view('images.show', compact('imageUrls', 'prompt'));

    }
}
