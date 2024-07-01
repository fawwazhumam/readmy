<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Readmy') }}</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts -->
    <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
    @vite('resources/css/app.css')
</head>

<body>
    @include("partials.header")

    <main class="min-h-screen">
        <div id="drawer" class="drawer lg:drawer-open">
            <input id="my-drawer" type="checkbox" class="drawer-toggle" />
            <div id="main-content" class="drawer-content p-4">
                @yield('content')
            </div>
            <div class="drawer-side" id="app-drawer">
                <label for="my-drawer" aria-label="open sidebar" class="drawer-overlay"></label>
                <ul class="menu p-4 w-64 min-h-full bg-base-100 text-base fixed md:static">
                    <li><a href="/"><i class="fa-solid fa-house"></i> Home</a></li>
                    <li><a href="AboutUs"><i class="fa-solid fa-users"></i> About Us</a></li>
                    <li><a href="Popular"><i class="fa-solid fa-fire"></i> Popular</a></li>
                    <li><a href="LatestUpdate"><i class="fa-solid fa-newspaper"></i> Latest Update</a></li>

                    <div class="divider"></div>

                    @auth
                    <li>
                        <a href="{{ route('viewSaved') }}"><i class="fa-solid fa-book-bookmark"></i> Saved</a>
                    </li>
                    <li>
                        <a href="{{ route('UploadPage') }}"><i class="fa-solid fa-cloud-arrow-up"></i> Upload</a>
                    </li>
                    @endauth
                    <div>
                        @guest @if (Route::has('login'))
                        <li>
                            <a href="{{ route('login') }}"><i class="fa-solid fa-user"></i> Login</a>
                        </li>
                        @endif @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}"><i class="fa-solid fa-door-open"></i> Register</a>
                        </li>
                        @endif @else
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i> {{ __("Logout") }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </div>
                </ul>
            </div>
        </div>
    </main>

    @include("partials.footer")

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document
                .getElementById("main-content")
                .classList.add("animate-[load_0.5s_ease-in-out]");
        });
    </script>
</body>

</html>