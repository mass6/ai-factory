<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--            Completions--}}
{{--        </h2>--}}
{{--    </x-slot>--}}
    <div class="container max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="row justify-content-md-center text-gray-800">
            <div class="my-6">
                <span class="font-bold">Prompt: </span>{{ $prompt }}
            </div>
            <ul>
                @foreach ($completions as $completion)
                    <li class="text-gray-800">{{ $completion['text'] }}</li>
                @endforeach
            </ul>
        </div>
        <div class="mb-4 mt-4">
            <a href="/completions/create" type="button" class="px-4 py-2 font-bold text-white bg-blue-500 rounded-md hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                Try Another
            </a>
        </div>
    </div>
</x-app-layout>
