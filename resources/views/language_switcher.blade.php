<div class="my-4 text-white">
    <p class="my-4 nav-link dropdown-toggle"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        {{ Config::get('languages')[App::getLocale()] }}
    </p>
    @foreach (Config::get('languages') as $lang => $language)
        {{--        @if ($lang != App::getLocale())--}}
        <a class="dropdown-item block" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
        {{--        @endif--}}
    @endforeach
</div>
