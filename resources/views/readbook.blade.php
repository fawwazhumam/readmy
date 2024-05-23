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
          <!-- flipbook section -->
          <section
            class="relative min-h-[32rem] h-[80vh] max-h-[80vh] mb-8 bg-secondary rounded-lg"
          >
            <div id="flipbook" class="h-[90%] relative flex justify-center items-center">
              <i
                class="fa-solid fa-angle-left py-8 px-2 absolute left-4 top-1/2 -translate-y-1/2 text-white text-5xl cursor-pointer hover:bg-black hover:bg-opacity-40 duration-300 rounded-md"
              ></i>

              <!-- flipbook -->

              <div id="book" class="h-[96%] w-1/4 min-w-48 bg-white shadow-white">a</div>

              <!-- flipbook -->

              <i
                class="fa-solid fa-angle-right py-8 px-2 absolute right-4 top-1/2 -translate-y-1/2 text-white text-5xl cursor-pointer hover:bg-black hover:bg-opacity-40 duration-300 rounded-md"
              ></i>
            </div>

            <div
              id="flipbook-controller"
              class="absolute bottom-0 left-0 rounded-b-lg w-full h-[10%] bg-black bg-opacity-30 border-t-2 border-gray-100 flex flex-col items-center gap-2 px-4 py-2"
            >
              <progress class="bg-white h-[2px] w-full" value="30" max="100"></progress>
              <div class="w-full flex justify-between items-center text-white">
                <p>3/10 Page</p>
                <div class="flex items-center gap-4 text-lg">
                <form action="{{ route('likeFile', $file) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sky-500"><i class="fa-regular fa-heart"></i></button>
                    <span>{{ $file->likes }}</span>
                </form>
                  <button>
                  </button>
                  <button>
                    <i class="fa-solid fa-share"></i>
                  </button>
                  <button>
                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                  </button>
                </div>
              </div>
            </div>
          </section>
          <!-- end of flipbook section -->

          <!-- profile information -->
          <section class="mb-8">
            <div class="mb-6">
              <h1 class="text-2xl font-bold">{{ $file->Title }}</h1>
              <p class="text-sm">by <span>{{ $file->user->First_Name }}</span></p>
            </div>
            <div class="w-96 flex justify-between items-center gap-8 mb-8">
              <div class="w-[40%] flex items-center gap-2 cursor-pointer">
                <a href="{{ route('showProfile', $file->user->id) }}">
                <img class="w-full" src="{{ asset('Photo/' . $file->user->File_Name) }}" style="width: 65px; height: 65px; object-fit: cover; object-position: center; border-radius: 50%" alt="profile" />
                <p>{{ $file->user->First_Name }}</p>
                </a>
              </div>
              <div>
              @auth
                  @if(Auth::user()->id !== $file->user_id) <!-- Prevent self-follow -->
                      @if(Auth::user()->followings->contains($file->user_id))
                          <form action="{{ route('unfollow', $file->user_id) }}" method="POST">
                              @csrf
                              <button type="submit" class="px-4 py-2 font-semibold shadow-lg bg-red-500 text-white rounded-full hover:bg-gray-200 shadow-sm duration-300">Unfollow</button>
                          </form>
                      @else
                          <form action="{{ route('followUser', $file->user_id) }}" method="POST">
                              @csrf
                              <button type="submit" class="px-4 py-2 font-semibold shadow-lg bg-green-500 text-white rounded-full hover:bg-gray-200 shadow-sm duration-300">Follow</button>
                          </form>
                      @endif
                  @endif
                  @if(Auth::user()->savedBooks->contains($file->id))
                      <form action="{{ route('removeBook', $file->id) }}" method="POST">
                          @csrf
                          <button type="submit" class="px-4 py-2 font-semibold shadow-lg bg-red-500 text-white rounded-full hover:bg-gray-200 shadow-sm duration-300">Remove Bookmark</button>
                      </form>
                  @else
                      <form action="{{ route('saveBook', $file->id) }}" method="POST">
                          @csrf
                          <button type="submit" class="px-4 py-1 bg-gray-100 font-bold rounded-full hover:bg-gray-200 shadow-sm duration-300"">Bookmark</button>
                      </form>
                  @endif
                @endauth
              </div>
            </div>

            <p><i class="fa-solid fa-user"></i> Followers: {{ $file->user->followers_count }}</p>
            <hr class="p-4">

            <div class="w-2/3">
              <h2 class="text-xl font-bold mb-2">About</h2>
              <p>
                {{ $file->Desc }}
              </p>
              <p><i class="fa-solid fa-bookmark"></i> {{ $file->bookmarks_count }} Bookmarks</p>
            </div>
          </section>
          <!-- end of profile information -->

          <!-- more from writer -->
          <section class="h-max mb-8">
            <h2 class="font-bold text-lg mb-4">More From Writer</h2>
            <div id="card-book-container" class="flex gap-4 flex-wrap">
            @foreach ($file->user->files as $otherFile)
              <a href="{{ route('ReadBook', $otherFile->id) }}" class="w-56 h-96 p-4 bg-[#fafaf9] shadow-lg rounded-lg">
                <img
                  class="w-full h-4/5 rounded-md"
                  src="{{ asset('images/card-book-placeholder.jpg') }}"
                  alt="book"
                />
                <div>
                  <h4 class="font-bold">{{ $otherFile->Title }}</h4>
                  <p>Published by <span class="text-sky-500">{{ $file->user->First_Name }}</span></p>
                </div>
              </a>
              @endforeach
            </div>
          </section>
          <!-- end of more from writer -->
        </div>

        <!-- end of main content -->
      </main>

      <!-- end of main section -->
</body>

@endsection