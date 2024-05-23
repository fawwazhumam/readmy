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


       
        <ul>
        @foreach ($followers as $follower)
                    <li>
                        <img src="{{ asset('Photo/' . $follower->File_Name) }}" alt="profile" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                        {{ $follower->First_Name }} {{ $follower->Last_Name }}
                        
                        @if (!in_array($follower->id, $followingIds))
                            <form action="{{ route('followBack', $follower->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-primary">Follow Back</button>
                            </form>

                            <form action="{{ route('removeFollower', $follower->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Remove Follower</button>
                            </form>
                        @endif

                        @if (in_array($follower->id, $followingIds))
                            <form action="{{ route('removeFollower', $follower->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Remove Follower</button>
                            </form>
                        @endif
                    </li>
                @endforeach
    </ul>
        
        <!--<div class="flex w-1/2 items-center justify-center mt-4">
            
            <button class="bg-gray-600 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">&lt;</button>
        
            
            <div class="flex items-center">
                <button class="bg-gray-400 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mx-1">1</button>
                <button class="bg-gray-400 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mx-1">2</button>
                <button class="bg-gray-400 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mx-1">3</button>
                <button class="bg-gray-400 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mx-1">4</button>
                <button class="bg-gray-400 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mx-1">5</button>
            </div>
        
            <button class="bg-gray-600 hover:bg-green-600 text-white font-bold py-2 px-4 rounded ml-2">&gt;</button>
        </!--</div>-->
        
        

        </div>
        


    </div>
</body>

@endsection