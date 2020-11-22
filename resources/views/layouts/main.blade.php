
{{-- LAYOUTS CREATO DA NOI --}}
@include('layouts.partials.head')

<body>

        @include('layouts.partials.header')

        @yield('mainContent')
        @yield('content')

        @include('layouts.partials.footer')

    <!-- script -->
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>
