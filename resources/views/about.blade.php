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
          <h1 class="text-2xl text-center my-4 mb-8 font-bold">
            "Books weave a tapestry of boundless fantasies, where every page whispers secrets of
            enchanted realms waiting to be explored."
          </h1>
          <!-- how to section -->
          <section class="h-max mb-8">
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
        </div>

        <!-- end of main content -->
      </main>

      <!-- end of main section -->
    </div>
    <script src="assets/scripts/main.js"></script>
</body>
@endsection