<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laut') }}</title>

    @guest @else
    <script src="{{ asset('js/app.js') }}"></script>
    @endguest


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <div class="c-Header container">
            <div class="c-Header_branding">
                <a class="c-Header_branding_cta" href="{{ url('/chat') }}">
                    {{ config('app.name', 'Laut') }}
                </a>
            </div>

            <div class="c-Header_meta">
                @guest
                    @if (Route::has('login'))
                        <a class="c-Header_meta_cta" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif

                    @if (Route::has('register'))
                        <a class="c-Header_meta_cta" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else

                <div class="c-Header_meta_user">{{ Auth::user()->name }}</div>
                    <a class="c-Header_meta_cta" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest

            </div>

        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>