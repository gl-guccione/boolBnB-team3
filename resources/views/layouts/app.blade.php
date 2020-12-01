{{-- including head --}}
@include('partials.head')

{{-- including header --}}
@include('partials.header')

    <main id="@yield('pageName')" class="py-6">
      @yield('content')
    </main>

{{-- including footer --}}
@include('partials.footer')