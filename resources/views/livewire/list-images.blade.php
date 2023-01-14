<div class="py-6 px-4 sm:px-6 lg:px-8">

    <!--Gallery 1-->
    <div class="mx-auto space-y-2 lg:gap-2 lg:grid lg:grid-cols-4">
        @include('images._gallery', ['images' => $images])
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

