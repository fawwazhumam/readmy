@extends('layouts.app')

@section('content')

<body>
    <div id="app">

      <!-- main section -->

      <main class="flex gap-6 min-h-screen p-6 bg-white">
        <!-- sidebar -->

        <aside id="sidebar" class="w-1/6 px-4 flex flex-col justify-between">
                    <div>
                        <ul class="flex flex-col justify-center gap-2 mb-12">
                        <li
                            class="flex items-center gap-4 py-2 px-4 rounded-md hover:bg-secondary hover:text-white transition duration-300"
                        >
                            <i class="fa-solid fa-house"></i>
                            <a href="/">Home</a>
                        </li>
                        <li
                            class="flex items-center gap-4 py-2 px-4 rounded-md hover:bg-secondary hover:text-white transition duration-300"
                        >
                            <i class="fa-solid fa-user"></i>
                            <a href="AboutUs">About Us</a>
                        </li>
                        <li
                            class="flex items-center gap-4 py-2 px-4 rounded-md hover:bg-secondary hover:text-white transition duration-300"
                        >
                            <i class="fa-solid fa-fire"></i>
                            <a href="Popular">Popular</a>
                        </li>
                        <li
                            class="flex items-center gap-4 py-2 px-4 rounded-md hover:bg-secondary hover:text-white transition duration-300"
                        >
                            <i class="fa-solid fa-newspaper"></i>
                            <a href="LatestUpdate">Latest Update</a>
                        </li>
                        </ul>

                        <div class="border-[1px] border-secondary"></div>
                        @auth
                            <ul class="flex flex-col justify-center gap-2 mt-12">
                                <li
                                    class="flex items-center gap-4 py-2 px-4 rounded-md hover:bg-secondary hover:text-white transition duration-300"
                                >
                                    <i class="fa-solid fa-bookmark"></i>
                                    <a href="{{ route('viewSaved') }}">Saved</a>
                                </li>
                                <li
                                    class="flex items-center gap-4 py-2 px-4 rounded-md hover:bg-secondary hover:text-white transition duration-300"
                                >
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                    <a href="{{ route('UploadPage') }}">Upload</a>
                                </li>
                            </ul>
                        @endauth
                    </div>
                    <div>
                        <li
                        class="flex items-center gap-4 py-2 px-4 rounded-md hover:bg-secondary hover:text-white transition duration-300"
                        >
                        <i class="fa-solid fa-gear"></i>
                        <a href="#">Setting</a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li
                                class="flex items-center gap-4 py-2 px-4 rounded-md hover:bg-secondary hover:text-white transition duration-300"
                                >
                                <i class="fa-solid fa-user"></i>
                                <a href="{{ route('login') }}">Login</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li
                                class="flex items-center gap-4 py-2 px-4 rounded-md hover:bg-secondary hover:text-white transition duration-300"
                                >
                                <i class="fa-solid fa-book-open"></i>
                                <a href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @else
                            <li
                            class="flex items-center gap-4 py-2 px-4 rounded-md hover:bg-secondary hover:text-white transition duration-300"
                            >
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            </form>
                            </li>
                        @endguest
                    </div>
        </aside>
        <!-- end of sidebar -->

        <!-- main content -->
        <div class="flex-1">
            @if(request()->has('query'))
                <section class="h-max mb-8">
                    <h2 class="font-bold text-lg">Search Results</h2>
                    
                    <!-- File Results -->
                    <h3 class="font-bold text-md mt-4">Books</h3>
                    @if($fileResults->isEmpty())
                        <p>No books found.</p>
                    @else
                        <div id="card-book-container" class="flex gap-4 flex-wrap">
                            @foreach ($fileResults as $file)
                                <a href="#" class="w-56 h-96 p-4 bg-[#fafaf9] shadow-lg rounded-lg">
                                    <img class="w-full h-4/5 rounded-md" src="{{ asset('images/card-book-placeholder.jpg') }}" alt="book" />
                                    <div>
                                        <h4 class="font-bold">{{ $file->title }}</h4>
                                        <p>Published by <span class="text-sky-500">{{ $file->user->First_Name ?? 'Unknown' }}</span></p>
                                        <form action="{{ route('likeFile', $file) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-sky-500">Like</button>
                                            <span>{{ $file->likes }} likes</span>
                                        </form>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                    
                    <!-- User Results -->
                    <h3 class="font-bold text-md mt-4">Users</h3>
                    @if($userResults->isEmpty())
                        <p>No users found.</p>
                    @else
                        <div id="user-list-container" class="flex gap-4 flex-wrap">
                            @foreach ($userResults as $user)
                                <div class="w-56 p-4 bg-[#fafaf9] shadow-lg rounded-lg">
                                    <div>
                                        <a href="{{ route('showProfile', $user->id) }}" class="flex gap-2 items-center">
                                            <img src="{{ asset('Photo/' . Auth::user()->File_Name) }}" style="width: 50px; height: 50px; object-fit: cover; object-position: center; border-radius: 50%" alt="profile" />
                                            <h4 class="font-bold">{{ $user->First_Name }} {{ $user->Last_Name }}</h4>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>
            @endif
        </div>

        <!-- end of main content -->
      </main>

      <!-- end of main section -->
    </div>
</body>

@endsection
