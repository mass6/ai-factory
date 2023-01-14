<div class="flex items-center justify-center mt-12">
    <div>
        <form wire:submit.prevent="save">
            <input type="file" wire:model="file">
            @error('file') <span class="error">{{ $message }}</span> @enderror
            <div wire:loading wire:target="upload">
                Loading...
            </div>
            <div wire:loading.remove wire:target="upload">
                @if ($file)
                    <img src="{{ $file->temporaryUrl() }}" alt="Preview of uploaded file">
                @endif
            </div>
            <button type="submit" class="block mt-4 px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Create Variations</button>
        </form>

        @if(! empty($images))
            <div class="mx-auto space-y-2 lg:gap-2 lg:grid lg:grid-cols-4">
                @include('images._gallery', ['images' => $images])
            </div>
        @endif
    </div>
</div>
