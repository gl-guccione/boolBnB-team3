
{{-- LAYOUT CREATO DA DOMENICO SULLA COPIA DI APP.BLADE.PHP (PER NON MODIFICARE TUTTE LE ROTTE NEI FILE DI LARAVEL) --}}
@include('partials.head')
@include('partials.header')

{{-- CONTENT E` IL SEGNAPOSTO DELL APP DI LARAVEL DOVE NEL LOGIN E REGISTER CI SONO I COLLEGAMENTI --}}
@yield('content')

{{-- MAINCONTENT E` IL NOSTRO SEGNAPOSTO DOVE METTERENO LE NOSTRE SEZIONI DELLA HOME --}}
@yield('mainContent')

@include('partials.footer')
