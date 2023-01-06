<x-app-layout>
    <div class="container max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="row justify-content-md-center text-gray-800">
            <div class="my-6">
                <h2 class="text-xl">Source Image</h2>
                <img src="{{ $sourceFileUrl }}" alt="Image" class="object-scale-down h-96">
            </div>
            <h2 class="text-xl">Generated Variations</h2>
            <div class="flex flex-wrap justify-between">
                @foreach ($imageUrls as $i => $url)
                    <a href="{{ $url }}" target="_blank">
                        <img src="{{ $url }}" alt="Image {{ $i }}" class="object-scale-down h-96">
                    </a>
                @endforeach
            </div>
        </div>
        <div class="mb-4 mt-4">
            <a href="/images/variations/create" type="button" class="px-4 py-2 font-bold text-white bg-blue-500 rounded-md hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                Try again
            </a>
        </div>
    </div>
</x-app-layout>
