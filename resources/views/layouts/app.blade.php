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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- Scripts -->
    <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
    @vite('resources/css/app.css')
</head>
<body>


    <div id="app">
        <header class="flex justify-between items-center px-10 py-4 bg-white shadow relative top-0 z-10">
            <a href="/">
                <img src="{{ asset('images/favicon.png') }}" alt="logo" />
            </a>

            @auth
                <form class="flex relative" action="{{ route('search') }}" method="GET">
                    <input
                        class="py-2 px-4 pr-8 border-2 border-secondary rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 focus:ring-offset-white focus:border-opacity-0 transition duration-300"
                        type="text"
                        placeholder="Search..."
                        name="query"
                    />
                    <button
                        class="absolute right-4 top-1/2 -translate-y-1/2 rounded-r-full flex items-center justify-center"
                        type="submit"
                    >
                        <i class="fa-solid fa-search text-secondary"></i>
                    </button>
                </form>
            @endauth

            <div class="relative">
            <a onclick="document.querySelector('#dropdown-menu').classList.toggle('hidden')" href="#" id="dropdown-btn" class="flex gap-2 items-center">
                @auth
                    <img src="{{ asset('Photo/' . Auth::user()->File_Name) }}" style="width: 50px; height: 50px; object-fit: cover; object-position: center; border-radius: 50%" alt="profile" />
                    {{ Auth::user()->First_Name }}
                @else
                    <img src="{{ asset('images/profile.png') }}" alt="profile" />
                @endauth
                <i class="fa-solid fa-angle-down"></i>
            </a>


                <div id="dropdown-menu" class="hidden absolute right-0 -bottom-[6.5rem] w-36 bg-white rounded-md py-2 shadow-sm border-[1px] border-secondary border-opacity-70">
                @guest
                    @if (Route::has('login'))
                        <ul class="flex flex-col w-full">
                            <li class="px-6 py-2 hover:bg-secondary hover:bg-opacity-30 duration-200">
                                <a href="{{ route('login') }}" class="flex gap-2 items-center">
                                <i class="fa-solid fa-user"></i>
                                <span>Login</span>
                                </a>
                            </li>
                        </ul>
                    @endif
                    @if (Route::has('register'))
                        <ul class="flex flex-col w-full">
                                <li class="px-6 py-2 hover:bg-secondary hover:bg-opacity-30 duration-200">
                                    <a href="{{ route('register') }}" class="flex gap-2 items-center">
                                    <i class="fa-solid fa-book-open"></i>
                                    <span>Register</span>
                                    </a>
                                </li>
                        </ul>
                    @endif
                @else        
                    <ul class="flex flex-col w-full">
                    <li class="px-6 py-2 hover:bg-secondary hover:bg-opacity-30 duration-200">
                        <a href="/Profile" class="flex gap-2 items-center">
                        <i class="fa-solid fa-user"></i>
                        <span>Profile</span>
                        </a>
                    </li>
                    <li class="px-6 py-2 hover:bg-secondary hover:bg-opacity-30 duration-200">
                        <a href="/Dashboard" class="flex gap-2 items-center">
                        <i class="fa-solid fa-book"></i>
                        <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="px-6 py-2 hover:bg-secondary hover:bg-opacity-30 duration-200">
                        <a class="flex gap-2 items-center" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>{{ __('Logout') }}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        </form>
                    </li>
                    </ul>
                @endguest
                </div>
            </div>
        </header>

        <main class="py-4">
            @yield('content')
        </main>

        <!-- footer -->
        <footer class="py-6 px-16 border-t-2 border-primary">
            <div class="flex justify-between mb-4">
            <a href="/">
                <img src="{{ asset('images/favicon.png') }}" alt="logo" />
                <p class="font-bold">Readmy.com</p>
            </a>
            <div class="flex gap-4">
                <a class="hover:text-primary duration-200" href="/">Home</a>
                <a class="hover:text-primary duration-200" href="AboutUs">About Us</a>
                <a class="hover:text-primary duration-200" href="Popular">Popular</a>
                <a class="hover:text-primary duration-200" href="LatestUpdate">Update</a>
            </div>
            </div>
            <div class="text-center my-4">
            <p class="py-2">
                "Books weave a tapestry of boundless fantasies, where every page whispers secrets of
                enchanted realms waiting to be explored."
            </p>
            <p class="py-2 text-secondary">&copy; 2024 Readmy and Team. All rights reserved.</p>
            </div>
            <div class="border-t-2 border-primary border-spacing-8 flex justify-center gap-4 pt-4">
            <a href="#"><i class="fa-brands fa-linkedin text-3xl text-sky-700"></i></a>
            <a href="https://instagram.com/illyaz.ai" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram text-3xl text-rose-500"></i></a>
            </div>
        </footer>
        <!-- end of footer -->
    </div>
</body>
</html>
