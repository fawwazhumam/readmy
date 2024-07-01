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
            <div class="drawer-side">
                <label for="my-drawer" aria-label="open sidebar" class="drawer-overlay"></label>
                <ul class="menu p-4 w-64 min-h-full bg-base-100 text-base fixed md:static">
                    <li><a href="{{ route('admin.reports') }}"><i class="fa-solid fa-file-circle-exclamation"></i>Reports</a></li>
                    <li><a href="{{ route('admin.viewFiles') }}"><i class="fa-solid fa-book"></i> All files</a></li>
                    <li><a href="{{ route('admin.viewUsers') }}"><i class="fa-solid fa-address-book"></i>Accounts</a></li>
                    <li><a href="{{ route('admin.register') }}"><i class="fa-solid fa-user-plus"></i> Add admin</a></li>
                    <div class="divider"></div>
                    <div>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i> {{ __("Logout") }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </li>
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