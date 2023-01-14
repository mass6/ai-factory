@foreach ($images as $image)
    <div class="card mt-5 ml-10 ">
        <!--Card 1-->
        <div class="max-w-sm rounded overflow-hidden shadow-2xl bg-gray-100">
            <img class="w-full object-cover" src="{{$image->url}}" alt="{{ $image->imageable->prompt }}">
            <div class="px-6 py-4">
                <p class="text-gray-700 text-lg">
                    {{ $image->imageable->prompt }}
                </p>
            </div>
            <div class="px-6 pt-4 pb-2">
                <button wire:click="retry({{ $image }})" type="button" class="inline-block bg-red-500 rounded-full px-3 py-1 text-sm font-semibold text-gray-100 mr-2 mb-2 cursor-pointer hover:bg-red-600 transition delay-50 duration-300 ease-in-out">Retry</button>
                <button wire:click="variation({{ $image }})" type="button" class="inline-block bg-red-500 rounded-full px-3 py-1 text-sm font-semibold text-gray-100 mr-2 mb-2 cursor-pointer hover:bg-red-600 transition delay-50 duration-300 ease-in-out">New Variation</button>
            </div>
        </div>
    </div>
@endforeach
