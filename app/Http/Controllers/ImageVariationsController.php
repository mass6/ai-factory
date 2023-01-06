<?php

namespace App\Http\Controllers;

use App\Models\ImageVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OpenAI\Laravel\Facades\OpenAI;

class ImageVariationsController extends Controller
{
    public function create()
    {
        return view('images.variations.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:40000',
        ]);

        $file = $request->file('file');
        $filepath = $file->store('images/variations/sources', 's3');
        $sourceFileUrl = Storage::disk('s3')->url($filepath);
        $storedFile = fopen($sourceFileUrl, 'r');
        $filename = basename($filepath);

        $imageVariation = ImageVariation::create([]);
        $imageVariation->images()->create(['path' => $filepath]);

        $response = OpenAI::images()->variation([
            'image' => $storedFile,
            'size' => '1024x1024',
            'n' => 3,
        ]);

        $imageUrls = collect($response->data)
            ->map(fn ($item) => $item->url)
            ->map(function ($url) {
                $contents = file_get_contents($url);
                $id = (string) Str::ulid();
                Storage::disk('s3')->put('images/variations/results/'.$id . '.png', $contents);

                return 'images/variations/results/'. $id. '.png';
            })
            ->each(function($filePath) use ($imageVariation) {
                $imageVariation->images()->create(['path' => $filePath]);
            })
            ->map(function ($filePath) {
                return Storage::disk('s3')->url($filePath);
            })
            ->toArray();

        logger()->info('image variations', ['image' => $filename, 'urls' => $imageUrls]);

        return view('images.variations.show', compact('imageUrls', 'sourceFileUrl'));
    }
}
