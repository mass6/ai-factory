<?php

namespace App\Http\Livewire;

use App\Models\Image;
use App\Models\ImageVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use OpenAI\Laravel\Facades\OpenAI;

class CreateVariation extends Component
{
    use WithFileUploads;

    public $image;
    public $file;
    public $images;

    public function mount(Image $image, Request $request)
    {
        $this->image = $image->exists ? $this->image : null;
    }

    public function render()
    {
        return view('livewire.create-variation');
    }

    public function upload()
    {
        $this->validate([
            'file' => 'required|image|max:1024',
        ]);

        $this->file = $this->storeFile();
    }

    public function save()
    {
        $this->validate([
            'file' => 'required|image|max:40000',
        ]);

        // $this->image->store('photos');

        $file = $this->file;
        $filepath = $file->store('images/variations/sources', 's3');
        $sourceFileUrl = Storage::disk('s3')->url($filepath);
        $storedFile = fopen($sourceFileUrl, 'r');
        $filename = basename($filepath);

        $imageVariation = ImageVariation::create([]);
        $imageVariation->images()->create(['path' => $filepath]);

        $response = OpenAI::images()->variation([
            'image' => $storedFile,
            'size' => '1024x1024',
            'n' => 5,
        ]);

        $images = collect($response->data)
            ->map(fn ($item) => $item->url)
            ->map(function ($url) {
                $contents = file_get_contents($url);
                $id = (string) Str::ulid();
                Storage::disk('s3')->put('images/variations/results/'.$id . '.png', $contents);

                return 'images/variations/results/'. $id. '.png';
            })
            ->map(function($filePath) use ($imageVariation) {
                return $imageVariation->images()->create(['path' => $filePath]);
            });

        logger()->info('image variations', ['image' => $filename, 'urls' => $images]);

        $this->images = $images;
    }
}
