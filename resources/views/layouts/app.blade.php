{{-- including head --}}
@include('partials.head')

{{-- including header --}}
@include('partials.header')

    <main class="py-4">
      @yield('content')
    </main>

{{-- including footer --}}
@include('partials.footer')