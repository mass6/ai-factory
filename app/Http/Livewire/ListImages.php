<?php

namespace App\Http\Livewire;

use App\Models\Image;
use App\Models\ImageCreation;
use Livewire\Component;
use Livewire\WithPagination;

class ListImages extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.list-images', [
            'images' => Image::with('imageable')
                ->where('imageable_type', ImageCreation::class)
                ->latest()
                ->paginate(15)
        ]);
    }

    public function retry(Image $image)
    {
        session()->flash('prompt', $image->imageable->prompt);

        return redirect()->to('/images/create');
    }

    public function variation(Image $image)
    {
        return redirect()->route('images.variations.create', ['image' => $image]);
    }
}
