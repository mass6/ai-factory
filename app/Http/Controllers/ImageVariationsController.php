<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $filepath = $file->store('public/uploads');
        $filename = basename($filepath);
        $storedFile = fopen(storage_path('app/' . $filepath), 'r');

        $response = OpenAI::images()->variation([
            'image' => $storedFile,
            'size' => '1024x1024',
            'n' => 3,
        ]);

        $imageUrls = collect($response->data)->map(fn ($item) => $item->url)->toArray();
        logger()->info('image variations', ['image' => $filename, 'urls' => $imageUrls]);

        return view('images.variations.show', compact('imageUrls', 'filename'));
    }
}
