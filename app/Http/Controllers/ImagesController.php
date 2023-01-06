<?php

namespace App\Http\Controllers;

use App\Models\ImageCreation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
        $size = '256x256';

        /** @var ImageCreation $imageCreation */
        $imageCreation = ImageCreation::create([
            'prompt' => $prompt,
            'quantity' => $quantity,
            'size' => $size,
        ]);

        $response = OpenAI::images()->create([
            'prompt' => $prompt,
            'model' => 'image-alpha-001',
            'size' => $size,
            'n' => $quantity,
        ]);

        $imageUrls = collect($response->data)
            ->map(fn ($item) => $item->url)
            ->map(function ($url) {
                $contents = file_get_contents($url);
                $id = (string) Str::ulid();
                Storage::disk('s3')->put('images/creations/'.$id . '.png', $contents);

                return 'images/creations/'. $id. '.png';
            })
            ->each(function($filePath) use ($imageCreation) {
                $imageCreation->images()->create(['path' => $filePath]);
            })
            ->map(function ($filePath) {
                return Storage::disk('s3')->url($filePath);
            })
            ->toArray();


        logger()->info('images', ['prompt' => $prompt, 'urls' => $imageUrls]);
        session()->flash('prompt', $prompt);

        return view('images.show', compact('imageUrls', 'prompt'));

    }
}
