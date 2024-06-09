<header class="navbar bg-base-100 px-10 relative z-10 shadow">
    <div class="navbar-start flex items-center gap-4">
        <i onclick="document.querySelector('#drawer').classList.toggle('drawer-open')" class="fa-solid fa-bars text-3xl lg:hidden"></i>
        <a href="/">
            <img src="{{ asset('images/favicon.png') }}" alt="logo" />
        </a>
    </div>

    @auth
    <div class="navbar-center flex-none gap-2 hidden md:block">
        <form class="form-control" action="{{ route('search') }}" method="GET">
            <label class="input input-bordered flex items-center gap-2 rounded-full">
                <input type="text" name="query" class="grow" placeholder="Search" />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
                    <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                </svg>
            </label>
        </form>
    </div>
    @endauth

    <div class="navbar-end">
        <a href="/search">
            <i class="fa-solid fa-search text-2xl mr-2 md:hidden"></i>
        </a>
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="rounded-full flex items-center gap-2">
                    @auth
                    <img alt="Profile" src="{{ asset('Photo/' . Auth::user()->File_Name) }}" />
                    <!-- <p>{{ Auth::user()->First_Name }}</p> -->
                    @else
                    <img src="{{ asset('images/profile.png') }}" alt="profile" />
                    @endauth
                </div>
            </div>
            <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-md dropdown-content bg-base-100 rounded-box w-52">

                @guest @if (Route::has('login'))
                <li>
                    <a href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                </li>

                @endif @if (Route::has('register'))
                <li>
                    <a href="{{ route('register') }}"><i class="fa-solid fa-door-open"></i> Register</a>
                </li>

                @endif @else
                <li>
                    <a href="/Profile"><i class="fa-solid fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="/Dashboard"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>{{ __("Logout") }}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</header>