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
                            <a href="LatestUpdate">Update</a>
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
                <!-- hero section -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                <section
                    id="hero"
                    class="relative p-4 mb-8 h-[45vh] bg-no-repeat bg-cover bg-center flex items-center rounded-lg"
                    style="background-image: url('{{ asset('images/hero.jpg') }}');">
                    <form class="h-full flex flex-col items-center gap-4 bg-white bg-opacity-70 rounded-md">
                        <label
                        class="w-64 h-full flex flex-col items-center justify-center px-4 py-6 rounded-lg"
                        >
                        <img src="{{ asset('images/icon-upload.png') }}" alt="upload" />
                        <span
                            class="mt-4 text-base leading-normal bg-primary text-white px-4 py-1 rounded-md cursor-pointer transition duration-300"
                            >Upload File</span
                        >
                        <input type="file" class="hidden" />
                        </label>
                    </form>
                    </section>

                <!-- end of hero section -->

                <!-- how to section -->
                <section class="h-max mb-8 max-h-full">
                    <h1 class="text-2xl text-center font-bold my-4">Easy to Read and Upload Your Books</h1>
                    <!-- container -->
                    <div id="how-to-container" class="flex justify-evenly p-4">
                    <div class="w-1/3 flex flex-col items-center">
                        <div
                        id="box"
                        class="bg-primary relative w-36 h-36 flex justify-center items-center rounded-md shadow-md"
                        >
                        <i class="fa-solid fa-upload text-white text-5xl"></i>
                        <span
                            class="absolute left-1/2 -translate-x-1/2 -bottom-4 w-0 h-0 border-l-[20px] border-l-transparent border-t-[30px] border-t-primary border-r-[20px] border-r-transparent"
                        ></span>
                        </div>
                        <div class="flex gap-4 items-center my-4">
                        <div
                            class="w-10 h-10 bg-primary rounded-full text-white text-center leading-10 font-bold"
                        >
                            1
                        </div>
                        <p class="font-bold text-lg">Upload Your Book</p>
                        </div>
                    </div>

                    <div class="w-1/3 flex flex-col items-center">
                        <div
                        id="box"
                        class="bg-primary relative w-36 h-36 flex justify-center items-center rounded-md shadow-md"
                        >
                        <i class="fa-solid fa-square-plus text-white text-5xl"></i>
                        <span
                            class="absolute left-1/2 -translate-x-1/2 -bottom-4 w-0 h-0 border-l-[20px] border-l-transparent border-t-[30px] border-t-primary border-r-[20px] border-r-transparent"
                        ></span>
                        </div>
                        <div class="flex gap-4 items-center my-4">
                        <div
                            class="w-10 h-10 bg-primary rounded-full text-white text-center leading-10 font-bold"
                        >
                            2
                        </div>
                        <p class="font-bold text-lg">Add Title & Category</p>
                        </div>
                    </div>

                    <div class="w-1/3 flex flex-col items-center">
                        <div
                        id="box"
                        class="bg-primary relative w-36 h-36 flex justify-center items-center rounded-md shadow-md"
                        >
                        <i class="fa-solid fa-book text-white text-5xl"></i>
                        <span
                            class="absolute left-1/2 -translate-x-1/2 -bottom-4 w-0 h-0 border-l-[20px] border-l-transparent border-t-[30px] border-t-primary border-r-[20px] border-r-transparent"
                        ></span>
                        </div>
                        <div class="flex gap-4 items-center my-4">
                        <div
                            class="w-10 h-10 bg-primary rounded-full text-white text-center leading-10 font-bold"
                        >
                            3
                        </div>
                        <p class="font-bold text-lg">Publish and Read More Book</p>
                        </div>
                    </div>
                    </div>
                </section>
                <!-- end of how to section -->

                <!-- categories book section -->
                <section class="h-max mb-8">
                    <h2 class="font-bold text-lg">Categories</h2>
                    <div id="category-container" class="flex gap-2 my-4 max-w-full overflow-auto">
                        <button class="px-5 py-2 bg-primary text-white rounded-full" onclick="filterFiles('All')">All</button>
                        <button class="px-5 py-2 bg-primary bg-opacity-70 text-white rounded-full" onclick="filterFiles('Children')">Children</button>
                        <button class="px-5 py-2 bg-primary bg-opacity-70 text-white rounded-full" onclick="filterFiles('Adult')">Adult</button>
                        <button class="px-5 py-2 bg-primary bg-opacity-70 text-white rounded-full" onclick="filterFiles('Sport')">Sport</button>
                        <button class="px-5 py-2 bg-primary bg-opacity-70 text-white rounded-full" onclick="filterFiles('Game')">Game</button>
                        <button class="px-5 py-2 bg-primary bg-opacity-70 text-white rounded-full" onclick="filterFiles('Politics')">Politics</button>
                        <button class="px-5 py-2 bg-primary bg-opacity-70 text-white rounded-full" onclick="filterFiles('History')">History</button>
                        <button class="px-5 py-2 bg-primary bg-opacity-70 text-white rounded-full" onclick="filterFiles('Comedy')">Comedy</button>
                        <button class="px-5 py-2 bg-primary bg-opacity-70 text-white rounded-full" onclick="filterFiles('Horror')">Horror</button>
                        <button class="px-5 py-2 bg-primary bg-opacity-70 text-white rounded-full" onclick="filterFiles('Conspiracy')">Conspiracy</button>
                        <button class="px-5 py-2 bg-primary bg-opacity-70 text-white rounded-full" onclick="filterFiles('...')">...</button>
                    </div>
                    <div id="card-book-container" class="flex gap-4 flex-wrap">
                        @foreach ($files as $file)
                            <a href="{{ route('ReadBook', ['id' => $file->id]) }}" class="w-56 p-4 bg-[#fafaf9] shadow-lg rounded-lg">
                                <img class="w-full h-4/5 rounded-md" src="{{ asset('images/card-book-placeholder.jpg') }}" alt="book"/>
                                <div>
                                    <h4 class="font-bold">{{ $file->Title }}</h4>
                                    <p>Published by <span class="text-sky-500">{{ $file->user->First_Name }}</span></p>
                                    <p>{{ $file->created_at->format('d M Y') }}</p>
                                    <form action="{{ route('likeFile', $file) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-sky-500 fa-solid fa-heart"></button>
                                        <span>{{ $file->likes }}</span>
                                    </form>
                                    @auth
                                        @if(Auth::user()->savedBooks->contains($file->id))
                                            <form action="{{ route('removeBook', $file->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-red-500">Remove</button>
                                            </form>
                                        @else
                                            <form action="{{ route('saveBook', $file->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-green-500">Save</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
                <!-- end of categories book section -->

                <!-- popular section -->
                <section class="h-max mb-8">
                    <h2 class="font-bold text-lg">Popular</h2>
                    <div id="card-book-container" class="flex gap-4 my-4 flex-wrap">
                        @foreach ($popularFiles as $file)
                            <a href="{{ route('ReadBook', ['id' => $file->id]) }}" class="w-56 p-4 bg-[#fafaf9] shadow-lg rounded-lg">
                                <img class="w-full h-4/5 rounded-md" src="{{ asset('images/card-book-placeholder.jpg') }}" alt="book" />
                                <div>
                                    <h4 class="font-bold">{{ $file->Title }}</h4>
                                    @if ($file->user)
                                        <p>Published by <span class="text-sky-500">{{ $file->user->First_Name }}</span></p>
                                    @else
                                        <p>Published by <span class="text-sky-500">Unknown</span></p>
                                    @endif
                                    <p>{{ $file->created_at->format('d M Y') }}</p>
                                    <form action="{{ route('likeFile', $file) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-sky-500 fa-solid fa-heart"></button>
                                        <span>{{ $file->likes }}</span>
                                    </form>
                                    @auth
                                        @if(Auth::user()->savedBooks->contains($file->id))
                                            <form action="{{ route('removeBook', $file->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-red-500">Remove</button>
                                            </form>
                                        @else
                                            <form action="{{ route('saveBook', $file->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-green-500">Save</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
                <!-- end of popular section -->

                <!-- update section -->
                <section class="h-max mb-8">
                    <h2 class="font-bold text-lg">Latest Update</h2>

                    <div id="card-book-container" class="flex gap-4 my-4 flex-wrap">
                    @foreach ($lastestFiles as $file)
                        <a href="{{ route('ReadBook', ['id' => $file->id]) }}" class="w-56 h-150 p-4 bg-[#fafaf9] shadow-lg rounded-lg">
                            <img class="w-full h-4/5 rounded-md" src="{{ asset('images/card-book-placeholder.jpg') }}" alt="book" />
                            <div>
                                <h4 class="font-bold">{{ $file->Title }}</h4>
                                <p>Published by <span class="text-sky-500">{{ $file->user->First_Name ?? 'Unknown' }}</span></p>
                                <p>{{ $file->created_at->format('d M Y') }}</p>
                                <form action="{{ route('likeFile', $file) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-sky-500 fa-solid fa-heart"></button>
                                    <span>{{ $file->likes }}</span>
                                </form>
                                @auth
                                    @if(Auth::user()->savedBooks->contains($file->id))
                                        <form action="{{ route('removeBook', $file->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-red-500">Remove</button>
                                        </form>
                                    @else
                                        <form action="{{ route('saveBook', $file->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-green-500">Save</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </a>
                    @endforeach
                    </div>
                </section>
                <!-- end of update section -->

                <!-- ads section -->
                <!-- <section class="h-max mb-4">
                    <div class="w-full h-4/5">
                    <img class="w-full h-4/5 rounded-md" src="./assets/images/iklan_bola.png" />
                    </div>
                </section> -->
                <!-- end of ads section -->
                </div>

                <!-- end of main content -->
            </main>

            <!-- end of main section -->
        </div>
        <script src="{{ asset('js/main.js') }}"></script>

        <script>
            function filterFiles(category) {
                fetch(`/files/category/${category}`)
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById('card-book-container');
                        container.innerHTML = '';

                        data.forEach(file => {
                            const fileElement = `
                                <a href="/ReadBook/${file.id}" class="w-56 p-4 bg-[#fafaf9] shadow-lg rounded-lg">
                                    <img class="w-full h-4/5 rounded-md" src="/images/card-book-placeholder.jpg" alt="book"/>
                                    <div>
                                        <h4 class="font-bold">${file.Title}</h4>
                                        <p>Published by <span class="text-sky-500">${file.user.First_Name}</span></p>
                                        <p>${new Date(file.created_at).toLocaleDateString()}</p>
                                        <form action="/files/${file.id}/like" method="POST">
                                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                            <button type="submit" class="text-sky-500 fa-solid fa-heart"></button>
                                            <span>${file.likes}</span>
                                        </form>
                                        ${file.saved ? 
                                            `<form action="/remove-book/${file.id}" method="POST">
                                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                                <button type="submit" class="text-red-500">Remove</button>
                                            </form>` : 
                                            `<form action="/save-book/${file.id}" method="POST">
                                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                                <button type="submit" class="text-green-500">Save</button>
                                            </form>`}
                                    </div>
                                </a>
                            `;
                            container.insertAdjacentHTML('beforeend', fileElement);
                        });
                    })
                    .catch(error => console.error('Error fetching files:', error));
            }
        </script>
    </body>
@endsection