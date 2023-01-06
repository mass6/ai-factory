<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Image Variations
        </h2>
    </x-slot>
    <div class="flex items-center justify-center mt-12">
        <form method="POST" action="/images/variations" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" />
            <button type="submit" class="block mt-4 px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Upload</button>
        </form>
    </div>

</x-app-layout>
