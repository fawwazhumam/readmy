@extends('layouts.app')

@section('content')
<body>
    <div id="app">
        <main class="flex gap-6 min-h-screen p-6 bg-white">
        @yield('content')

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
                            <i class="fa-solid fa$user"></i>
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
                                <i class="fa-solid fa$user"></i>
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

            <div class="flex-1 relative">
                <div class="px-48 py-12">
                    <section id="hero" class="relative bg-slate-400 bg-no-repeat bg-cover bg-center flex items-center rounded-lg">
                        <img class="w-full rounded-xl" src="{{ asset('Photo/' . $user->Header_File_Name) }}">
                    </section>
                    <section class="absolute px-24 left-4 transform translate-x-1/2 -translate-y-1/2 mb-2 z-10">
                        <img class="w-48 h-48 shadow-lg text-center rounded-full border-4 bg-slate-500 border-white" style="object-fit: cover; object-position: center;" src="{{ asset('Photo/' . $user->File_Name) }}">
                    </section>
                </div>
                <div class="px-48 py-24">
                    <section class="px-24 py-4 flex justify-between items-center">
                        <div>
                            <h2 class="py-4 font-bold text-xl">{{ $user->First_Name }}</h2>
                            <p><a href="{{ route('viewFollowings') }}">Following: </a> {{ $user->followings_count }}</p>
                            <p><a href="{{ route('viewFollowers') }}">Followers: </a> {{ $user->followers_count }}</p>
                            <br>
                            
                            <p>Student at Universitas Amikom Yogyakarta,
                            @if ($user->Gender == 'Male')
                                (he/him)
                            @elseif ($user->Gender == 'Female')
                                (she/her)
                            @else
                                (prefer not to say)
                            @endif
                            </p>
                        </div>
                    </section>
                    <section class="px-24">
                        <div>
                            <a>Joined {{$user->created_at->format('d M Y') }}</a>
                            <a class="px-2">📍 {{ $user->Address }}</a>
                            <a class="px-2">❤️ {{ $totalLikes }}</a>
                        </div>
                        <h2 class="py-4 font-bold">About</h2>
                        <p>{{ $user->Bio }}</p>
                        <h2 class="py-4 font-bold">Tag</h2>
                        <div id="category-container" class="flex gap-4 my-2">
                            <button class="px-5 py-2 bg-green-600 text-white rounded-full">ALL</button>
                            <button class="px-5 py-2 bg-green-600 bg-opacity-70 text-white rounded-full">Adult</button>
                            <button class="px-5 py-2 bg-green-600 bg-opacity-70 text-white rounded-full">Children</button>
                        </div>
                    </section>
                    
                    <section class="py-12">
                        <h2 class="font-bold text-lg">My Books</h2>
                        <div id="card-book-container" class="flex gap-4 my-4">
                        @foreach($files as $file)
                            <a href="{{ route('viewFile', ['fileName' => $file->File_Name]) }}" class="w-56 h-96 p-4 bg-[#fafaf9] shadow-lg rounded-lg">
                                <img class="w-full h-4/5 rounded-md" src="{{ asset('images/card-book-placeholder.jpg') }}" alt="book"/>
                                <div>
                                    <h4 class="font-bold">{{$file->Title}}</h4>
                                    <p>Published by <span class="text-sky-500">{{ $user->First_Name }}</span></p>
                                    @if ($file->Type == 'Public')
                                        🟢 Published
                                    @else
                                        🔴 Private
                                    @endif
                                </div>
                            </a>
                        @endforeach
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>
</body>
@endsection
