<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--            Completions--}}
{{--        </h2>--}}
{{--    </x-slot>--}}
    <div class="container max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">


        <!--Gallery 1-->
        <div class="container mx-auto space-y-2 lg:gap-2 lg:grid lg:grid-cols-3">
            @foreach ($images as $image)
{{--                <div class="flex flex-wrap mx-2">--}}
{{--                    <div class="px-2">--}}
{{--                        <div class="relative rounded-lg overflow-hidden">--}}
{{--                            <img class="w-full h-96 object-contain" src="{{$image->url}}" alt="{{ $image->imageable->prompt }}">--}}
{{--                            <div class="absolute bottom-0 left-0 right-0 p-4 bg-white border-b border-gray-800">--}}
{{--                                <p class="text-sm">{{ $image->imageable->prompt }}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="card mt-5 ml-10 ">
                    <!--Card 1-->
                    <div class="max-w-sm rounded overflow-hidden shadow-2xl bg-gray-100">
                        <img class="w-full" src="{{$image->url}}" alt="{{ $image->imageable->prompt }}">
                        <div class="px-6 py-4">
                            <p class="text-gray-700 text-base">
                                {{ $image->imageable->prompt }}
                            </p>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                            <span class="inline-block bg-red-500 rounded-full px-3 py-1 text-sm font-semibold text-gray-100 mr-2 mb-2 cursor-pointer hover:bg-red-600 transition delay-50 duration-300 ease-in-out">#tailwind</span>
                            <span class="inline-block bg-red-500 rounded-full px-3 py-1 text-sm font-semibold text-gray-100 mr-2 mb-2 cursor-pointer hover:bg-red-600 transition delay-50 duration-300 ease-in-out">#frontendeverything</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!--/Gallery 1-->

        <div class="px-4 my-4">
            <div class="w-full">
                {{ $images->links() }}
            </div>
        </div>


        <div class="mb-4 my-6">
            <a href="/images/create" type="button" class="px-4 py-2 font-bold text-white bg-blue-500 rounded-md hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                Create Image
            </a>
        </div>
    </div>
</x-app-layout>
