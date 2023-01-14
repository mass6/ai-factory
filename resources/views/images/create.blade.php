<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Images
        </h2>
    </x-slot>
    <div class="flex items-center justify-center mt-12">
        <form method="post" action="/images" class="w-2/3">
            @csrf
            <label for="prompt" class="block text-lg font-bold">Enter text to generate image:</label>
            <textarea type="prompt" id="prompt" rows="6" name="prompt" class="w-full mt-2">{{ session()->get('prompt') }}</textarea>
            <label for="quantity" class="block mt-4">Quantity:</label>
            <select id="quantity" name="quantity" class="mt-2">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <button type="submit" class="block mt-4 px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Generate Image</button>
        </form>
    </div>

</x-app-layout>
