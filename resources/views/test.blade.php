<h1>Session Variables</h1>
<h2>Locale: {{ app()->getLocale() }}</h2>
<p>{{ json_encode($vars) }}
@include('language_switcher')
