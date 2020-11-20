@include('layouts.partials.head')

<body>
    <nav>
        @include('layouts.partials.navbar')
    </nav>
    
    <header>
        @include('layouts.partials.jumbo')
    </header>

      
    <main>
        @yield('mainContent')
    </main>

    <footer>
        @include('layouts.partials.footer')
    </footer>

    <!-- script -->
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>
