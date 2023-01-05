<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Completions
        </h2>
    </x-slot>
    <form method="POST" action="{{ route('completions.store') }}" class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @csrf
        <div class="mb-4">
            <label for="prompt" class="block font-bold mb-2 text-gray-700">Prompt</label>
            <textarea name="prompt" rows="6" id="prompt" class="form-input w-full rounded-md py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-blue-500" required></textarea>
        </div>
{{--        <div class="mb-4">--}}
{{--            <label for="model" class="block font-bold mb-2 text-gray-700">Model</label>--}}
{{--            <input type="text" name="model" id="model" class="form-input rounded-md py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-blue-500" required>--}}
{{--        </div>--}}
{{--        <div class="mb-4">--}}
{{--            <label for="max_tokens" class="block font-bold mb-2 text-gray-700">Max Tokens</label>--}}
{{--            <input type="number" name="max_tokens" id="max_tokens" class="form-input rounded-md py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-blue-500" required>--}}
{{--        </div>--}}
        <div class="mb-4">
            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                Submit
            </button>
        </div>
    </form>
</x-app-layout>
